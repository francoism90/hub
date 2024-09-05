@setup
    $repository = 'git@github.com:francoism90/hub.git';
    $branch = 'main';
    $baseDir = '/home/foxws/hub';
@endsetup

@servers(['remote' => 'hub'])

@story('deploy')
    maintenance-mode
    update-repository
    build-containers
    restart-containers
    install-dependencies
    clear-caches
    update-application
    build-assets
    restart-services
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
        php artisan app:update --force;
    ";
@endtask

@task('build-assets', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        yarn run build;
    ";
@endtask

@task('restart-services', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan up;
    ";
@endtask
