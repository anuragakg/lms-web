<script id="approver_template" type="text/template">
    <tr id="approver_{{random_id}}">
        <td>
            <span class="approver_no"></span>
        </td>
        <td>
            <select class="form-control " name="approver[role][]" id="approver_role_{{random_id}}" onchange="getUsers(this.value,{{random_id}})" value="" required><option value="">Select Role</option></Select>
        </td>
        <td>
            <select class="form-control " name="approver[user][]" id="approver_user_{{random_id}}" value="" required>Select User</Select>
        </td>
        <td>
            <a href="javascript:void(0)" onclick="delete_approver({{random_id}})" ><i class="fa fa-trash"></i></a>
        </td>
        
    </tr>
</script>
<script>
var roles='';
$(function () {
    
            
});
function getUsers(role_id,random_id){
    var url = conf.fetchRoleUsers.url;
    var method = conf.fetchRoleUsers.method;
    var data = {role_id};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            users=response.data;
            html='<option value="">Select users</option>';
            users.forEach((row)=>{
                html +='<option value="'+row.id+'">'+row.name+'</option>'
            });
            $('#approver_user_'+random_id).html(html);
        }
    });
}

function add_approver(row=[]){
    
    var random_id=Date.now();
    var data = { 
        random_id:random_id,
        row
    };
    var template = $("#approver_template").html();
    var text = Mustache.render(template, data);

  $("#approvers_container").append(text);
  renderRole(random_id);
  //console.log(row)
  if(row.role !=undefined){
    $('#approver_role_'+random_id).val(row.role).trigger('change');
    $('#approver_user_'+random_id).val(row.user_id);
  }
  
  inc_approver();
}
function inc_approver(){
    var approver_no=0;
    
    $(".approver_no").each(function() {
         ++approver_no;
        $(this).html(approver_no)
    });
}
function renderRole(random_id){
    html='<option value="">Select Role</option>';
    roles.forEach((row)=>{
        html +='<option value="'+row.id+'">'+row.title+'</option>'
    });
    $('#approver_role_'+random_id).html(html);
}
fetchRoleList = () => {
    var url = conf.getRoleList.url;
    var method = conf.getRoleList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            roles=response.data;
           
        }
    });
}
function delete_approver(random_id){
    $('#approver_'+random_id).remove();
    inc_approver()
}
</script>