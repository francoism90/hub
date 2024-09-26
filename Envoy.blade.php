@setup
    $repository = 'git@github.com:francoism90/hub.git';
    $branch = 'main';
    $baseDir = '/home/foxws/hub';
@endsetup

@servers(['remote' => 'foxws'])

@story('setup')
    setup-environment
@endstory

@story('build')
    update-repository
    build-containers
    restart-containers
@endstory

@story('rebuild')
    update-repository
    rebuild-containers
    restart-containers
@endstory

@story('deploy')
    maintenance-mode
    update-repository
    install-dependencies
    clear-caches
    generate-assets
    update-application
    finish-deploy
@endstory

@task('setup-environment', ['on' => 'remote'])
    mkdir -p {{ $baseDir }}
    git clone --depth 1 {{ $repository }} {{ $baseDir }}
@endtask

@task('maintenance-mode', ['on' => 'remote'])
    podman exec -it systemd-hub-app php artisan down --with-secret
@endtask

@task('update-repository', ['on' => 'remote'])
    cd {{ $baseDir }}
    git pull origin {{ $branch }}
@endtask

@task('build-containers', ['on' => 'remote'])
    cd {{ $baseDir }}/podman
    ./make
@endtask

@task('rebuild-containers', ['on' => 'remote'])
    cd {{ $baseDir }}/podman
    ./update
@endtask

@task('restart-containers', ['on' => 'remote'])
    systemctl --user daemon-reload
    systemctl --user restart hub-app hub
@endtask

@task('install-dependencies', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        composer install --prefer-dist --no-scripts -q -o &&
        yarn install;
    ";
@endtask

@task('clear-caches', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan optimize:clear;
    ";
@endtask

@task('update-application', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan app:update --assets;
    ";
@endtask

@task('generate-assets', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        yarn run build;
    ";
@endtask

@task('finish-deploy', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan up;
    ";
@endtask
