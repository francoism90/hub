@setup
    $repository = 'git@github.com:francoism90/hub.git';
    $branch = 'main';
    $remote = 'foxws';
    $remotePath = '/home/foxws/hub';
@endsetup

@servers(['remote' => $remote])

@story('deploy')
    maintenance-mode
    update-repository
    install-dependencies
    generate-assets
    update-application
    optimize-application
    finish-deploy
@endstory

@story('deploy-build')
    maintenance-mode
    update-repository
    build-containers
    finish-deploy
@endstory

@task('maintenance-mode', ['on' => 'remote'])
    podman exec -it systemd-hub-app php artisan down --with-secret
@endtask

@task('install-dependencies', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        composer install --prefer-dist --no-scripts -q -o &&
        yarn install;
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

@task('update-application', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan app:update;
    ";
@endtask

@task('optimize-application', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan app:optimize;
    ";
@endtask

@task('setup-environment', ['on' => 'remote'])
    mkdir -p {{ $remotePath }}
    git clone --depth 1 {{ $repository }} {{ $remotePath }}
@endtask

@task('update-repository', ['on' => 'remote'])
    cd {{ $remotePath }}
    git pull origin {{ $branch }}
@endtask

@task('build-containers', ['on' => 'remote'])
    cd {{ $remotePath }}/build-tools/podman/images
    podman build -t hub-app:latest -f app/Dockerfile {{ $args }}
    podman build -t hub-nginx:latest -f nginx/Dockerfile {{ $args }}
@endtask

@task('restart-containers', ['on' => 'remote'])
    systemctl --user daemon-reload
    systemctl --user restart hub-app hub
@endtask
