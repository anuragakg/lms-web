$(function() {
  dashboardGraphCount();
});

dashboardGraphCount = () => {
  var url = conf.getDashboardData.url;
    var method = conf.getDashboardData.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
      //console.log(response);
        if (response.status) {
          
            $('#vertical_total').html(response.data.vertical_total);
            $('#category_total').html(response.data.category_total);
            $('#form_total').html(response.data.form_total);
            $('#sub_category_total').html(response.data.sub_category_total);
            $('#mini_category_total').html(response.data.mini_category_total);
            $('#lead_category_total').html(response.data.lead_category_total);
            $('#staff_users').html(response.data.staff_users);

        } 
        
    });
}
