#Documentation
 This is a good boy's craft, make sure that you have to use it as good as me.

#Tutorials
1. php artisan kave:install
2. fill all the requirements
3. enjoy

#API features
 // Authentication user
        post=>login=>Admin\Controllers\Rest\UsersApi@login');
        get=>decode=>Admin\Controllers\Rest\UsersApi@decode');
        post=>register=>Admin\Controllers\Rest\UsersApi@register');
        post=>address=>Admin\Controllers\Rest\UsersApi@setaddress');
        get=>addresslist=>Admin\Controllers\Rest\UsersApi@getaddress');
 // get list front "menu, cat, banner"
        get=>banners=>Admin\Controllers\Rest\BannersApi@getlist');
        get=>menulist=>Admin\Controllers\Rest\MenusApi@getList');
        get=>menupoint=>Admin\Controllers\Rest\MenusApi@menupoint');
        get=>abc=>Admin\Controllers\Rest\MenusApi@abc');
        get=>categorieses=>Admin\Controllers\Rest\CategoriesApi@getlist');
        get=>mealtimes=>Admin\Controllers\Rest\MealtimesApi@getlist');
        get=>customerlist=>Admin\Controllers\Rest\UsersApi@getlistcus');
        get=>location=>Admin\Controllers\Rest\LocationsApi@getlist');
        get=>pages=>Admin\Controllers\Rest\PagesApi@getlist');
 // Reservation
        get=>reservationlist=>Admin\Controllers\Rest\ReservationApi@getlist');
        post=>booking=>Admin\Controllers\Rest\ReservationApi@booking');
 // make order 
        get=>orderList=>Admin\Controllers\Rest\OrdersApi@getList');
        post=>makeorder=>Admin\Controllers\Rest\OrdersApi@postData');
 // Reviews
        get=>reviews=>Admin\Controllers\Rest\ReviewsApi@getlist');
        post=>postreviews=>Admin\Controllers\Rest\ReviewsApi@postreviews');
 //Menu Point
        get=>menupoint=>Admin\Controllers\Rest\MenuPointApi@getlist');
        get=>pointlist=>Admin\Controllers\Rest\MenuPointApi@pointlist');


#Please Forgive ME if that isn't espect as you think