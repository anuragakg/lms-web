const role_id = TRIFED.getUrlParameters().id;
$(function() {
  getPermission();
  if(role_id != undefined)
  {
	  getRolePermission(role_id);
  }
  $("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
           
            
        },
        messages: {
            
		},
	    submitHandler: function(form) { 
	        
			//const data=$('#formID').serializeArray();
			
    		
			var url = conf.addRolePermission.url;
			var method = conf.addRolePermission.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		if (role_id != undefined && role_id != '') 
			{
				data.append('role_id', role_id );
			}
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Saved Successfully');
					setTimeout(function() { window.location = 'roles.php'}, 1500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});
});

getPermission = () => {
  var url = conf.getPermissionList.url;
  var method = conf.getPermissionList.method;
  var data = {};
  var options = "";
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      renderPermissions(response.data);
      return;
    }
  });
};

function renderPermissions(data) {
  $("#permission_container").html("");
  let index = 1;
  for (const group in data) {
    
	console.log(group)
	let group_tr='<tr>';
	group_tr +='<th>'+index+'</th>';
	group_tr +='<th>'+ucFirstAllWords(group)+'</th>';
	group_tr +='<th></th>';
	group_tr +='</tr>';
	$('#permission_container').append(group_tr);
	if (Array.isArray(data[group])) {
      data[group].forEach(v => {
        const data = {
          name: v.name,
          group: group,
          type: "td",
          id: v.id
        };
		let group_module_tr='<tr>';
		group_module_tr +='<td></td>';
		group_module_tr +='<td>'+v.description+'</td>';
		group_module_tr +='<td><input type="checkbox" name="permission_id[]" value="'+v.alias+'"></td>';
		group_module_tr +='</tr>';
		$('#permission_container').append(group_module_tr);
        //appendRow(mustacheTemplates.permission, data);
      });
    }
    
    index++;
  }
}

function ucFirstAllWords( str )
{
    var pieces = str.split("_");
    for ( var i = 0; i < pieces.length; i++ )
    {
        var j = pieces[i].charAt(0).toUpperCase();
        pieces[i] = j + pieces[i].substr(1);
    }
    return pieces.join(" ");
}

function appendRow(template, _data) {
  const rendered = Mustache.render(template, _data);
  $("#permission_container").append(rendered);
}

function check_uncheck_checkbox(isChecked) {
  if (isChecked) {
    $('input[name="permission_id[]"]').each(function() {
      this.checked = true;
    });
  } else {
    $('input[name="permission_id[]"]').each(function() {
      this.checked = false;
    });
  }
}

/**
 * Renders option element
 * @param {string} id ID
 * @param {Array} records
 */
function renderOptionElements(id, records) {
  const el = $("select" + id);
  el.html("");
  el.append($('<option value="">').text("Please Select"));
  records.forEach(element => {
    el.append(
      $("<option>")
        .val(element.id)
        .text(element.title)
    );
  });
}
$("#role_id").on("change", function() {
  $(".permissions").each(function() {
    this.checked = false;
  });

  var role_id = $(this).val();
  var url = conf.getRolesMapping.url(role_id);
  var method = conf.getRolesMapping.method;
  var data = {};
  var options = "";
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      response_data = response.data;
      $.each(response_data, function(i, item) {
        var permission_id = response_data[i].permission_id;
        $("#permission-" + permission_id).prop("checked", true);
      });
      afterSettingPermissions();
    }
  });
});
$(document).ready(function() {
  $("#formId").validate({
    rules: {
      role_id: "required"
    },
    messages: {
      role_id: "Please select role"
    }
  });

  $("#save").click(function() {
    if ($("#formId").valid()) {
      var url = conf.addRolesMapping.url;
      var method = conf.addRolesMapping.method;
      var data = $("#formId").serializeArray();
      TRIFED.asyncAjaxHit(url, method, data, function(response) {
        if (response.status == 1) {
          response_data = response.data;

          TRIFED.showMessage("success", "Successfully Added");

          setTimeout(() => {}, 1000);
        } else {
          TRIFED.showError("error", response.message);
          z = false;
        }
      });
    }
  });
});

function ucFirst(s) {
  if (typeof s !== "string") return "";
  return s.charAt(0).toUpperCase() + s.slice(1);
}

function selectGroup(group, checked) {
  $("." + group).each(function(i, v) {
    v.checked = checked;
  });
}

function afterSettingPermissions() {
  toggleMasterPermissions();
}

function toggleMasterPermissions() {
  permissionGroups.forEach(permission => {
    const all = $(".permissions." + permission).length;
    const checked = $(".permissions." + permission + ":checked").length;
    if (all == checked) {
      $('#' + permission).prop("checked", true);
    }
  });
}

getRolePermission=(role_id)=>
{
	var url = conf.getRolePermission.url(role_id);
	var method = conf.getRolePermission.method;
	var data = {};
	var options = "";
	TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
	if (response) {
		response.data.forEach((row)=>{
			$(':checkbox[value="'+row.permission+'"]').prop("checked","true");
		})
	  

	}
	});
}
