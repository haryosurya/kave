#Documentation
 This is a good boy's craft, make sure that you have to use it as good as me.

#Tutorials
1. php artisan kave:install
2. fill all the requirements
3. php artisan config:clear
4. enjoy

#API features<br>
 // Authentication user<br>
        post=>login=>Admin\Controllers\Rest\UsersApi@login');<br>
        get=>decode=>Admin\Controllers\Rest\UsersApi@decode');<br>
        post=>register=>Admin\Controllers\Rest\UsersApi@register');<br>
        post=>address=>Admin\Controllers\Rest\UsersApi@setaddress');<br>
        get=>addresslist=>Admin\Controllers\Rest\UsersApi@getaddress');<br>
 // get list front "menu, cat, banner"<br>
        get=>banners=>Admin\Controllers\Rest\BannersApi@getlist');<br>
        get=>menulist=>Admin\Controllers\Rest\MenusApi@getList');<br>
        get=>menupoint=>Admin\Controllers\Rest\MenusApi@menupoint');<br>
        get=>abc=>Admin\Controllers\Rest\MenusApi@abc');<br>
        get=>categorieses=>Admin\Controllers\Rest\CategoriesApi@getlist');<br>
        get=>mealtimes=>Admin\Controllers\Rest\MealtimesApi@getlist');<br>
        get=>customerlist=>Admin\Controllers\Rest\UsersApi@getlistcus');<br>
        get=>location=>Admin\Controllers\Rest\LocationsApi@getlist');<br>
        get=>pages=>Admin\Controllers\Rest\PagesApi@getlist');<br>
 // Reservation<br>
        get=>reservationlist=>Admin\Controllers\Rest\ReservationApi@getlist');<br>
        post=>booking=>Admin\Controllers\Rest\ReservationApi@booking');<br>
 // make order <br>
        get=>orderList=>Admin\Controllers\Rest\OrdersApi@getList');<br>
        post=>makeorder=>Admin\Controllers\Rest\OrdersApi@postData');<br>
 // Reviews<br>
        get=>reviews=>Admin\Controllers\Rest\ReviewsApi@getlist');<br>
        post=>postreviews=>Admin\Controllers\Rest\ReviewsApi@postreviews');<br>
 //Menu Point<br>
        get=>menupoint=>Admin\Controllers\Rest\MenuPointApi@getlist');<br>
        get=>pointlist=>Admin\Controllers\Rest\MenuPointApi@pointlist');<br>
<br>
<br>
#Please Forgive ME if that isn't espect as you think<br>