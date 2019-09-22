<?php namespace App\Modules;
 
/**
* ServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*
* @author Kamran Ahmed <kamranahmed.se@gmail.com>
* @package App\Modules
*/

class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{




    /**
     * [includeModules Inclui modulos]
     * @param  [array] $modules
     * @return [void]
     */
    private function includeModules($modules) {

        include __DIR__ . '/../../routes/helper.php';

        foreach ($modules as $module){
            if(file_exists(__DIR__ . '/' . $module . '/routes.php')) {
                include __DIR__ . '/' . $module . '/routes.php';
            }
        }
    }

    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     */
    public function boot()
    {
        \Route::group([
            'middleware' => 'api'
        ], function ($router) {
            $modules = config("module.modules");
            $this->includeModules($modules);            
        });
    }

    public function register() {}
}
