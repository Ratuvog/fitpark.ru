set :stage, :production
server '176.57.210.39', roles: :all, port: 22 
set :branch, 'production'
set :deploy_to, '/home/w/whidohost/fitpark.rf'
namespace my do
   task custom_task do
       on roles :all do
        execute :ln, '-s',"#{fetch(:path_to_share)}/yandex_*", "#{fetch(:deploy_to)}/public_html"
        upload '/home/dmitry/fitpark.ru/fitpark.ru/config/deploy/production/.htaccess', "#{fetch(:deploy_to)}/public_html"
       end
   end
end
