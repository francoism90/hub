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
    restart-services
    finish-deploy
@endstory

@story('deploy-build')
    maintenance-mode
    update-repository
    build-containers
    restart-services
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
        php artisan optimize:clear;
        php artisan storage:link;
        php artisan migrate --force --seed;
        php artisan permission:cache-reset;
        php artisan structures:refresh;
        php artisan scout:sync-index-settings;

        @if ($assets)
            php artisan google-fonts:fetch
        @endif
    ";
@endtask

@task('optimize-application', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan optimize;
        php artisan icons:cache;
        php artisan config:cache;
        php artisan route:cache;
        php artisan view:cache;
        php artisan event:cache;
    ";
@endtask

@task('restart-services', ['on' => 'remote'])
    podman exec -it systemd-hub-app sh -c "
        php artisan octane:reload;
        php artisan horizon:terminate;
        php artisan reverb:restart;
        php artisan pulse:restart;
        php artisan pulse:clear --force;
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
    podman build -t hub-app:latest -f app/Dockerfile --no-cache
    podman build -t hub-nginx:latest -f nginx/Dockerfile --no-cache
@endtask

@task('restart-containers', ['on' => 'remote'])
    systemctl --user daemon-reload
    systemctl --user restart hub-app hub
@endtask
