<?php
/* get FavIcon */
function getFavIcon()
{
    $settings = new App\Models\MasterSetting();
    $site = $settings->siteData();
    if(isset($site['favicon']) && file_exists(public_path($site['favicon'])))
    {
        return asset($site['favicon']);
    }
    return asset('/assets/img/photos/no-item-image.jpg');
}
/* get Translations */
function getTranslation()
{
    if (session()->has('selected_language')) {   /*if session has selected language */
       return \App\Models\Translation::where('id', session()->get('selected_language'))->first();
    } else {
        /* if session has no selected language */
        return \App\Models\Translation::where('default', 1)->first();
    }
    return null;
}
/* get Store Name from App Settings */
function getStoreName()
{
    $settings = new App\Models\MasterSetting();
    $site = $settings->siteData();
    if(isset($site['store_name']))
    {
        return $site['store_name'];
    }
    return 'Stack POS';
}
/* get Currency from App Settings */
function getCurrency()
{
    $settings = new App\Models\MasterSetting();
    $site = $settings->siteData();
    if(isset($site['currency_symbol']))
    {
        return $site['currency_symbol'];
    }
    return '$';
}
/* get Tax Percentage from App Settings */
function getTaxPercentage()
{
    $settings = new App\Models\MasterSetting();
    $site = $settings->siteData();
    if(isset($site['tax_percentage']))
    {
        return $site['tax_percentage'];
    }
    return 0;
}
/* get Application Logo from App Settings */
function getApplicationLogo()
{
    $settings = new App\Models\MasterSetting();
    $site = $settings->siteData();
    if(isset($site['logo']) && file_exists(public_path($site['logo'])))
    {
        return asset($site['logo']);
    }
    return asset('assets/img/photos/empty.jpg');
}
?>