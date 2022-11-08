<?php
namespace App\Repositories;


use App\Models\GeneralSettings;
use App\Services\ImageService;
use Illuminate\Support\Facades\Artisan;

class SettingsRepository{
    /**
     * Update the resourece in general settings
     * @param $generalSettingsRequest $id
     * @return App\Models\GeneralSettings;
     */
    public function generalSettingsUpdate($generalSettingsRequestData, $id){
        $generalSettings = GeneralSettings::where('id',$id)->first();
        $imageService = new ImageService();
        $image_location = 'photo/settings/general/';
        $favicon = $generalSettings->favicon;
        $logo_sm_light = $generalSettings->logo_sm_light;
        $logo_sm_dark = $generalSettings->logo_sm_dark;
        $logo_lg_light = $generalSettings->logo_lg_light;
        $logo_lg_dark = $generalSettings->logo_lg_dark;
        
        if($generalSettingsRequestData->hasFile('favicon')){
            
            if($generalSettings->favicon != 'default_favicon.jpg'){   
                $imageService->delete($generalSettings->favicon, $image_location);
            }   
            $favicon =  $imageService->upload('favicon',$image_location,$generalSettingsRequestData->file('favicon'));
            
        }

        //small image
        if($generalSettingsRequestData->hasFile('logo_sm_light')){

            if($generalSettings->logo_sm_light != 'default_logo_sm_light.jpg'){   
                $imageService->delete($generalSettings->logo_sm_light, $image_location);
            }   
            $logo_sm_light =  $imageService->upload('logo_sm_light',$image_location,$generalSettingsRequestData->file('logo_sm_light'));
        }

        if($generalSettingsRequestData->hasFile('logo_sm_dark')){

            if($generalSettings->logo_sm_dark != 'default_logo_sm_dark.jpg'){   
                $imageService->delete($generalSettings->logo_sm_dark, $image_location);
            }   
            $logo_sm_dark =  $imageService->upload('logo_sm_dark',$image_location,$generalSettingsRequestData->file('logo_sm_dark'));
        }

        //large image
        if($generalSettingsRequestData->hasFile('logo_lg_light')){

            if($generalSettings->logo_lg_light != 'default_logo_lg_light.jpg'){   
                $imageService->delete($generalSettings->logo_lg_light, $image_location);
            }   
            $logo_lg_light =  $imageService->upload('logo_lg_light',$image_location,$generalSettingsRequestData->file('logo_lg_light'));
        }

        if($generalSettingsRequestData->hasFile('logo_lg_dark')){

            if($generalSettings->logo_lg_dark != 'default_logo_lg_dark.jpg'){   
                $imageService->delete($generalSettings->logo_lg_dark, $image_location);
            }   
            $logo_lg_dark =  $imageService->upload('logo_lg_dark',$image_location,$generalSettingsRequestData->file('logo_lg_dark'));
        }

        


       

        $generalSettings->favicon = $favicon;
        $generalSettings->logo_sm_light = $logo_sm_light;
        $generalSettings->logo_sm_dark = $logo_sm_dark;
        $generalSettings->logo_lg_light = $logo_lg_light;
        $generalSettings->logo_lg_dark = $logo_lg_dark;
        $generalSettings->name = $generalSettingsRequestData->name;
        $generalSettings->phone = $generalSettingsRequestData->phone;
        $generalSettings->email = $generalSettingsRequestData->email;
        $generalSettings->address = $generalSettingsRequestData->address;
        $generalSettings->facebook = $generalSettingsRequestData->facebook;
        $generalSettings->instagram = $generalSettingsRequestData->instagram;
        $generalSettings->twitter = $generalSettingsRequestData->twitter;
        $generalSettings->linkedin = $generalSettingsRequestData->linkedin;

        $generalSettings->save();
        return $generalSettings;

    }

   
}