let promodata, contentLoaded;
function formatDate(datestring) {
  const date = new Date();
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const short_months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

  const new_data = datestring.replace(/-/gi, "/")
  const formDate = new Date(new_data)
  // const formmated_date=new_data.getMonth()
  return `${formDate.getDate()} ${months[formDate.getMonth()]} ${formDate.getFullYear()}`;
}

function generateString(length) {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789~!@#$%^&*';

  let result = '';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }

  return result;
}
$(document).ready(() => {
  loadPromotions()
  setInterval(() => {
    console.log(contentLoaded)
  }, 2000)
})

$("#new-promotions").on("click", () => {
  newPromo();
})

$("#new-users").click(() => {
  newUser();
})
$("#users").on("click", () => loadUsers())
$("#promotions").on("click", () => loadPromotions())

function newPromo() {
  const myForm = document.createElement('form')
  $(myForm).attr("id", "promoregform")
  const formMainDiv = `<div class='row'><div class='col-md-4'><div class='form-group'><label>Promotions Name</label><input type='text'class='form-control form-control-lg' id='promoname' name='promoname'></div></div><div class='col-md-4'><div class='form-group'><label>Promotion Start Date</label><input type='date'class='form-control form-control-lg' id='startdate' name='promoname'></div></div><div class='col-md-4'><div class='form-group'><label>Promotion End Date</label><input type='date' class='form-control form-control-lg' id='enddate'name='promoname'></div></div></div>
    <div class='row'>
    <div class='col-md-12'><textarea class='form-control form-control-lg' cols='60' id='description' rows='6'></textarea></div>
    </div>
    <div class='row'>
    <div class='col-md-12' id='cover-priview'></div>
    </div>`
  $(myForm).append(formMainDiv)
  $("#modal-lg-title").html("Create Promotions")
  $("#modal-lg-body").html(myForm)
  $("#modal-lg-footer").html("<button type='button' id='createpromo' class='btn btn-primary ' onClick='createPromo()'>Create Promotions</button>")
}
function createPromo() {
  let promo_name = $("#promoname").val(), startdate = $("#startdate").val(), enddate = $("#enddate").val(), description = $("#description").val()
  if (promo_name === "" || startdate === "" || enddate === "") {
    alert("Please fill all the Fields")
  } else {
    $.ajax({
      type: "POST",
      url: "/promotions/admin/create-promotion",
      data: { promo_name, startdate, enddate, description },
      dataType: false,
      contentTye: false,
      cacheData: false,
      beforeSend: () => {
      },
      success: (res) => {
        $("#modal-lg-title").html("")
        $("#modal-lg-body").html("")
        $("#modal-lg-footer").html("")
        $("#modal-lg").fadeOut("slow")
        setTimeout(() => {
          if (contentLoaded == 'promotions') {
            loadPromotions()
          }
        }, 1500)
      },
      error: (err) => {
        alert(err.message)
      }
    })
  }
}

function viewPromo(id) {
  $("#modal-lg-title").html("View Promotions")
  // $("#modal-lg-body").html("")
  $.ajax({
    type: "POST",
    url: "/promotions/admin/getpromoInfo",
    data: { id },
    dataType: false,
    contentTye: false,
    cacheData: false,
    beforeSend: () => {
    },
    success: (data) => {
      // console.log(data)
      const res_data = JSON.parse(data), info_data = res_data.message, promo_data = info_data[0]
      console.log(promo_data)
      var Info_div = document.createElement("div")
      $(Info_div).addClass("container-fluid")
      $(Info_div).html(`
        <h3>${promo_data.promotion_name
        }</h3>
        
        <p ><span class="bi bi-calendar"></span> <i class="text-muted">${formatDate(promo_data.promotion_start_date)} -${formatDate(promo_data.promotion_end_date)}</i> <span class='${promo_data.status=='Active'?'text-success':''}'>${promo_data.status}</span></p>
        <hr>
        
        <div >
          <img src="public/images/uploads/${promo_data.coverImage}"/ class="img-fluid">
        
        </div>
        <div>
          ${promo_data.promotions_descript}
        </div>  
        `)
        
      $("#modal-lg-body").html(Info_div)
      $("#modal-lg-footer").html(`<button class='btn btn-primary'  onClick='updatePromo(${id})'>Update Infmoration</button>`)
     }
  })
}

function delPromo(id) {
  $("#modal-sm-title").html("Confirm your action")
  $("#modal-sm-body").html(` You sure you want to delete ${id} ?`)
  $("#modal-sm-footer").html(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  <button type="button" class="btn btn-primary" data-dismiss="modal" onClick='confirmDelPromo(${id})'>Confirm</button>`)
}
function confirmDelPromo(id) {
  $.ajax({
    type: "POST",
    url: "/promotions/admin/delet-promo",
    data: { id },
    dataType: false,
    contentTye: false,
    cacheData: false,
    beforeSend: () => {
    },
    success: (res) => {
      let resdata = JSON.parse(res)
      if (resdata.status === "success") {
        if (contentloaded == 'promotions') {
          loadPromotions();
        }
      } else {
        alert(resdata.message)
      }
    },
    error: (err) => {
      alert(err.name)
    }
  })
}
function updatePromo(id) {
  $("#modal-lg-title").html("Update  Promotions")
  $.ajax({
    type: "POST",
    url: "/promotions/admin/getpromoInfo",
    data: { id },
    dataType: false,
    contentTye: false,
    cacheData: false,
    beforeSend: () => {
    },
    success: (res) => {
      let resdata = JSON.parse(res);
      if (resdata.status === 'error') {
        alert(resdata.message)
      } else {
        let datam = resdata.message[0];
        $("#modal-lg-footer").html(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onClick='postUpadatePromo(${datam.id})'>Save changes</button>`)
        $("#modal-lg-body").html(`<div class='row'>
            <div class='col-md-4'>
            <div class='form-group'>
            <label>Promotion Name</label>
            <input type='text' class='form-control' id='promtion_name' value='${datam.promotion_name}'/>
            </div>
            </div>
            <div class='col-md-4'>
            <div class='form-group'>
            <label>Start Date</label><input type='date' class='form-control' id='promtion_start_date' value='${datam.promotion_start_date}'/>
            </div></div>
            <div class='col-md-4'>
            <div class='form-group'>
            <label>End Date</label>
            <input type='date' class='form-control' id='promtion_end_date' value='${datam.promotion_end_date}'/>
            </div>
            </div>
            </div>
            <div class='row'>
            <div class='col-md-12'>
            <div class='form-group'>
            <label>Description</label>
            <input type='text' class='form-control form-control-lg' id='description' value='${datam.promotions_descript}'/>
            </div>
            </div>
            </div>
            <div class='row'><div class='col-md-4'><div class='form-group'><label>Status</label><select class='form-control' id='status'><option>${datam.status}</option>${datam.status !== `Active` ? `<option>Active</option>` : ``}${datam.status}</option>${datam.status !== `Inactive` ? `<option>Inactive</option>` : ``}${datam.status !== `Upcomming` ? `<option>Upcomming</option>` : ``}</select></div></div></div>`)
      }
    },
    error: (err) => {
      alert(err.message)
    }
  })
}


function postUpadatePromo(id) {
  const promoname = $("#promtion_name").val(), startdate = $("#promtion_start_date").val(), enddate = $("#promtion_end_date").val(),
    description = $("#description").val(), status = $("#status").val()

  $.ajax({
    type: "POST",
    url: "/promotions/admin/update-promo",
    data: { id, promoname, startdate, enddate, description, status },
    dataType: false,
    contentTye: false,
    cacheData: false,
    beforeSend: () => {
    },
    success: (response) => {
      console.log(response)
      if (contentLoaded === 'promotions') {
        $("#modal-lg").fadeOut("slow")
        $("#modal-lg").attr({ 'arial-hidden': true })
        // $(document).attr({'data-dismiss':'modal'})
        loadPromotions();
      } else {

      }
    },
    error: (error) => {
      alert(error.message)
    }
  });
}
function loadPromotions() {
  $("#admin-section").html("/Promotions")
  $.ajax({
    type: "GET",
    url: "/promotions/admin/promotions",
    beforeSend: () => {
      $("#admin-pannel").html("<p class='text-center text-muted'><img src='/public/images/Spinner-1s-69pxclear.gif'/></p>")
    },
    success: (res) => {
      let data = JSON.parse(res);
      if (data.status === "error") {
        $("#admin-pannel").html("<p class='text-center text-muted'>No  Data Vailabe</p>")
      } else {
        promodata = data.message
        const dataTable = document.createElement("table")
        $(dataTable).addClass("table table-fluid table-striped");
        $(dataTable).append(`<tr><th>ID</th><th>Promotion Name</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Options  <button class='btn btn-primary float-right' title='Add new Promotion' onClick='newPromo()' data-target='#modal-lg'  data-toggle='modal'><i class='bi bi-plus-circle'></i></button></th></tr>`)
        promodata.forEach((element) => {
          $(dataTable).append(`<tr id='${element.id}'><td id=''>${element.id}</td><td><a href='/promotions/admin/promos/${element.id}'>${element.promotion_name}</a></td><td>${formatDate(element.promotion_start_date)}</td><td>${formatDate(element.promotion_end_date)}</td><td class='text-right ${element.status == 'Active' ? 'text-success' : ''}'>${element.status}</td><td><a href="#" class='btn btn-primary btn-sm ' data-target='#modal-lg'  data-toggle='modal' onClick='viewPromo(${element.id})'> <i class="bi bi-eye"></i></a> <a href="#" class='btn btn-primary btn-sm update-promo' data-target='#modal-lg'  data-toggle='modal' onClick='updatePromo(${element.id})'> <i class="bi bi-pencil-square"></i>Update</a> <a href="#" class='btn btn-danger btn-sm del-promo' onClick='delPromo(${element.id})' data-toggle="modal" data-target="#modal-sm-center"> <i class="bi bi-trash"></i> </a></td></tr>`)
        })
        $("#admin-pannel").html(dataTable)
        contentLoaded = 'promotions'
      }
    },
    error: (err) => {
      alert(err.message)
    }
  })
}

function logOut() {
  $.ajax({
    url: "/promotions/admin/logout",
    type: "POST",
    beforeSend: () => {

    },
    success: (res) => {
      let resdata = JSON.parse(res)
      if (resdata.response === 'success') {
        window.location.replace("")
      } else {
        alert(resdata.message);
      }
    },
    error: (err) => {
      alert(err.message)
    }
  })
}

function newUser() {
  const myForm = document.createElement('form')
  $(myForm).attr("id", "user-regform")
  const formMainDiv = `<div class='row'>
                        <div class='col-md-4'><div class='form-group'><label>Full Name</label><input type='text'class='form-control form-control-lg' id='fullname' name='fullname'></div></div>
                        <div class='col-md-4'><div class='form-group'><label>Email</label><input type='email' class='form-control form-control-lg' id='email'name='email'></div></div>
                        <div class='col-md-4'><div class='form-group'><label>Phone</label><input type='text' class='form-control form-control-lg' id='phone' name='phone'></div></div>
                    </div>
                    <div class='row'>
                    <div class='col-md-4'><div class='form-group'><label>Username</label><input type='text' class='form-control form-control-lg' id='username' name='username'></div></div>
                    <div class='col-md-4'>
                    <div class='form-group'><label>Password</label><input type='text'class='form-control form-control-lg' id='password' name='password'><button class='btn' type='button' onClick='generatePass()'>Generate Password</button></div>
                    </div>
                    <div class='col-md-4'>
                    <div class='form-group'><label>Satus</label><select class='form-control form-control-lg' id='status' name='status'><option>Active</option><option>Blocked</option><option>Disabled</option></select></div>
                    </div>
                    </div>
                <div class='row'>
                  <div class='col-md-12'>
                    <hr>
                  <p>Set Previlleges</p>
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox"  id="super-admin">
                      <label class="form-check-label" for="flexCheckDefault">
                       Super Admin
                      </label>
                      </div>
                      <div class="form-check">
                      <input class="form-check-input" type="checkbox"  id="portal-admin" >
                      <label class="form-check-label" for="flexCheckChecked">
                       Portal Administrator
                      </label>
                      </div>
                      <div class="form-check">
                      <input class="form-check-input" type="checkbox"  id="content-creator" >
                      <label class="form-check-label" for="flexCheckChecked">
                       Content Creator
                      </label>
                      </div>
                      <div class="form-check">
                      <input class="form-check-input" type="checkbox" checked id="portal-user" >
                      <label class="form-check-label" for="flexCheckChecked">
                       Portal User
                      </label>
                      </div>
                  </div>
                </div>`
  $(myForm).append(formMainDiv)
  $("#modal-lg-title").html("Create New User")
  $("#modal-lg-body").html(myForm)
  $("#modal-lg-footer").html("<button type='button' id='createuser' class='btn btn-primary ' onClick='createNewUser()'>Create User</button>")
}

function createNewUser() {
  let super_admin, portal_admin, content_creator, portal_user,
    fullname = $("#fullname").val(),
    email = $("#email").val(),
    phone = $("#phone").val(),
    username = $("#username").val(),
    password = $("#password").val(),
    status = $("#status").val();
  if (fullname === "" || email === "" || phone === "" || username === "" || password === "") {
    alert("Please fill all the Required fields")
  } else {
    if (!$("#super-admin").is(':checked') && !$("#portal-admin").is(':checked') && !$("#content-creator").is(':checked') && !$("#portal-user").is(':checked')) {
      alert("Please Pick atleast one user Previllege")
    } else {
      if ($("#super-admin").is(':checked')) {
        super_admin = "true";
      } else {
        super_admin = "false";
      }
      if ($("#portal-admin").is(':checked')) {
        portal_admin = "true"
      } else {
        portal_admin = "false"
      }
      if ($("#content-creator").is(':checked')) {
        content_creator = "true"
      } else {
        content_creator = "false"
      }
      if ($("#portal-user").is(':checked')) {
        portal_user = "true"
      } else {
        portal_user = "false"
      }
      $.ajax({
        type: "POST",
        url: "/promotions/admin/create-user",
        data: {
          super_admin, portal_admin, content_creator,
          portal_user, fullname, email, phone, username, password, status
        },
        dataType: false,
        contentTye: false,
        cacheData: false,
        beforeSend: () => {
          $("#createuser").html('<img src="/public/images/spinner30pxclear.gif"/>')
        },
        success: (res) => {
          let resdata = JSON.parse(res)
          if (resdata.status === 'success') {

            if (contentLoaded === 'users') {
              loadUsers()
            }
          } else {
            alert(resdata.message)
          }
        },
        error: (err) => {
          alert(err.message)
        }
      })
    }
  }
}

function loadUsers() {
  $("#admin-section").html("/Users")
  $.ajax({
    type: "GET",
    url: "/promotions/admin/users",
    beforeSend: () => {
      $("#admin-pannel").html("<p class='text-center text-muted'><img src='/public/images/Spinner-1s-69pxclear.gif'/></p>")
    },
    success: (res) => {
      let data = JSON.parse(res);
      if (data.status === "error") {
        $("#admin-pannel").html("<p class='text-center text-muted'>No  Data Vailabe</p>")
      } else {
        promodata = data.message
        const dataTable = document.createElement("table")
        $(dataTable).addClass("table table-fluid table-striped");
        $(dataTable).append(`<tr><th>ID</th><th> Name</th><th>Phone</th><th>Email</th><th>Account Status</th><th>Options  <button class='btn btn-primary float-right' title='Add new User' onClick='newUser()' data-target='#modal-lg'  data-toggle='modal'><i class='bi bi-plus-circle'></i></button></th></tr>`)
        promodata.forEach((element) => {
          $(dataTable).append(`<tr id='${element.id}'>
          <td id=''>${element.id}</td>
          <td>${element.fullname}</td>
          <td>${element.phone}</td>
          <td>${element.email}</td>
          <td class='${element.accout_status == 'Active' ? 'text-success' : ''}'>${element.accout_status}</td>
          <td><a  href="#" class='btn btn-primary btn-sm ' data-target='#modal-lg'  data-toggle='modal' title='View user information' onClick='viewUser(${element.id})'> <i class="bi bi-eye"></i></a> <a href="#" class='btn btn-primary btn-sm update-promo' data-target='#modal-lg' title='Update user information' data-toggle='modal' onClick='updateUser(${element.id})'> <i class="bi bi-pencil-square"></i>Update</a> ${element.create_user_prev == `true` ? `` : `<a href="#" class='btn btn-danger btn-sm del-promo' onClick='deleteUser(${element.id})' data-toggle="modal" data-target="#modal-sm-center" title='Delete this user' disabled> <i class="bi bi-trash" ></i> </a>`}</td>
          </tr>`)
        })
        $("#admin-pannel").html(dataTable)
        contentLoaded = 'users'
      }
    },
    error: (err) => {
      alert(err.message)
    }
  })
}


//View User information on a Dialgue Modal.
function viewUser(id) {
  $.ajax({
    type: "POST",
    url: "/promotions/admin/getuserInfo",
    data: { id },
    dataType: false,
    contentTye: false,
    cacheData: false,
    beforeSend: () => {
    },
    success: (res) => {

      let data = JSON.parse(res)
      if (data.status === "success") {
        let d = data.message[0]
        const myForm = document.createElement('div')
        $(myForm).attr("id", "user-view")
        const formMainDiv = `<div class='row'>
                           <div class='col-md-4'><div class='form-group'><label> Name</label><input type='text'class='form-control form-control-lg' id='fullname' name='fullname' value='${d.fullname}' disabled></div></div>
                             <div class='col-md-4'><div class='form-group'><label>Email</label><input type='email' class='form-control form-control-lg' id='email'name='email' value='${d.email}' disabled></div></div>
                             <div class='col-md-4'><div class='form-group'><label>Phone</label><input type='text' class='form-control form-control-lg' id='phone' name='phone'  value='${d.phone}' disabled></div></div>
                         </div>
                         <div class='row'>
                         <div class='col-md-4'><div class='form-group'><label>Username</label><input type='text' class='form-control form-control-lg' id='username' name='username'  value='${d.username}' disabled></div></div>

                         <div class='col-md-4'>
                         <div class='form-group'><label>Satus</label><select class='form-control form-control-lg' id='status' name='status' disabled><option>${d.accout_status}</option></select></div>
                         </div>
                         </div>
                     <div class='row'>
                       <div class='col-md-12'>
                         <hr>
                       <p> Previlleges</p>
                       <div class="form-check">
                          ${d.create_user_prev === `true` ? `<input class="form-check-input" type="checkbox"  id="super-admin" checked disabled>` : `<input class="form-check-input" type="checkbox"  id="super-admin" disabled>`}
                           <label class="form-check-label" for="flexCheckDefault">
                            Super Admin
                           </label>
                           </div>
                           <div class="form-check">
                           ${d.create_user_prev === `true` || d.create_promo_prev === `true` ? `<input class="form-check-input" type="checkbox"  id="portal-admin" checked disabled>` : `<input class="form-check-input" type="checkbox"  id="portal-admin" disabled>`}
                           <label class="form-check-label" for="flexCheckChecked">
                            Portal Administrator
                           </label>
                           </div>
                           <div class="form-check">
                           ${d.create_promo_prev === `true` ? `<input class="form-check-input" type="checkbox"  id="content-creator" checked disabled>` : `<input class="form-check-input" type="checkbox"  id="content-creator" disabled>`}
                           <label class="form-check-label" for="flexCheckChecked">
                            Content Creator
                           </label>
                           </div>
                           <div class="form-check">
                           <input class="form-check-input" type="checkbox" checked id="portal-user" disabled>
                           <label class="form-check-label" for="flexCheckChecked">
                            Portal User
                           </label>
                           </div>
                       </div>
                     </div>`
        $(myForm).append(formMainDiv)
        $("#modal-lg-title").html("Update User")
        $("#modal-lg-footer").html(`<button class='btn btn-primary' onClick='updateUser(${d.id})'>Update information</button>`)
        $("#modal-lg-body").html(myForm)
      } else {
        alert(data.message)
      }
    },
    error: (err) => {
      alert(err.message)
    }
  })

}


function loadUserInof(id) {
  let data = "";


}

function updateUser(id) {

  $("#modal-lg-title").html("Update  Promotions")
  $.ajax({
    type: "POST",
    url: "/promotions/admin/getuserInfo",
    data: { id },
    dataType: false,
    contentTye: false,
    cacheData: false,
    beforeSend: () => {
    },
    success: (res) => {
      let resdata = JSON.parse(res);
      if (resdata.status === 'error') {
        alert(resdata.message)
      } else {
        let datam = resdata.message[0];
        const myForm = document.createElement('form')
        $(myForm).attr("id", "user-regform")
        const formMainDiv = `<div class='row'>
                      <div class='col-md-4'><div class='form-group'><label>Full Name</label><input type='text'class='form-control form-control-lg' id='fullname' name='fullname' value='${datam.fullname}'></div></div>
                        <div class='col-md-4'><div class='form-group'><label>Email</label><input type='email' class='form-control form-control-lg' id='email'name='email' value='${datam.email}'></div></div>
                        <div class='col-md-4'><div class='form-group'><label>Phone</label><input type='text' class='form-control form-control-lg' id='phone' name='phone'  value='${datam.phone}'></div></div>
                    </div>
                    <div class='row'>
                    <div class='col-md-4'><div class='form-group'><label>Username</label><input type='text' class='form-control form-control-lg' id='username' name='username'  value='${datam.username}' disabled></div></div>
                    <div class='col-md-4'>
                    <div class='form-group'><label>Password</label><input type='text'class='form-control form-control-lg' id='upassword' name='password'><button type="button" class="btn" onClick='generatePassword()'>Reset Password</button></div>
                    </div>
                    <div class='col-md-4'>
                    <div class='form-group'><label>Satus</label><select class='form-control form-control-lg' id='status' name='status'><option>${datam.accout_status}</option>${datam.accout_status !== `Active` ? `<option>Active</option>` : ``}${datam.accout_status}</option>${datam.accout_status !== `Blocked` ? `<option>Blocked</option>` : ``}${datam.accout_status}</option>${datam.accout_status !== `Disabled` ? `<option>Disabled</option>` : ``}</select></div>
                    </div>
                    </div>
                <div class='row'>
                  <div class='col-md-12'>
                    <hr>
                  <p> Previlleges</p>
                  <div class="form-check">

                      ${datam.create_user_prev === `true` ? `<input class="form-check-input" type="checkbox"  id="super-admin" checked>` : `<input class="form-check-input" type="checkbox"  id="super-admin">`}

                      <label class="form-check-label" for="flexCheckDefault">
                       Super Admin
                      </label>
                      </div>
                      <div class="form-check">
                      ${datam.create_user_prev === `true` || datam.create_promo_prev === `true` ? `<input class="form-check-input" type="checkbox"  id="portal-admin" checked>` : `<input class="form-check-input" type="checkbox"  id="portal-admin" >`}

                      <label class="form-check-label" for="flexCheckChecked">
                       Portal Administrator
                      </label>
                      </div>
                      <div class="form-check">

                      ${datam.create_user_prev === `true` || datam.create_promo_prev === `true` && datam.update_promo_prev == `true` ? `<input class="form-check-input" type="checkbox"  id="content-creator" checked>` : `<input class="form-check-input" type="checkbox"  id="content-creator" >`}

                      <label class="form-check-label" for="flexCheckChecked">
                       Content Creator
                      </label>
                      </div>
                      <div class="form-check">
                      <input class="form-check-input" type="checkbox" checked id="portal-user" >
                      <label class="form-check-label" for="flexCheckChecked">
                       Portal User
                      </label>
                      </div>
                  </div>
                </div>`
        $(myForm).append(formMainDiv)
        $("#modal-lg-title").html("Update User")
        $("#modal-lg-body").html(myForm)
        $("#modal-lg-footer").html(`<button type='button' id='updateUser' class='btn btn-primary ' onClick='postUpdateUser(${datam.id})'>Save User Info</button>`)
      }
    },
    error: (err) => {
      alert(err.message)
    }
  })
}

function deleteUser(id) {
  $("#modal-sm-title").html("Confirm your action")
  $("#modal-sm-body").html(` You sure you want to delete this Users ?`)
  $("#modal-sm-footer").html(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" data-dismiss="modal" onClick='confirmDelUser(${id})'>Confirm</button>`)
}
function confirmDelUser(id) {
  let uid = id;
  $.ajax({
    type: "POST",
    url: "/promotions/admin/delete-user",
    data: { uid },
    dataType: false,
    contentTye: false,
    cacheData: false,
    beforeSend: () => { },
    success: (res) => {
      const resdata = JSON.parse(res)
      if (resdata.status == 'success') {
        if (contentLoaded == "users") {
          loadUsers();
        }
      } else {
        alert(resdata.message)
      }
    },
    error: (err) => {
      alert(err.message)
    }
  }
  )
}


function postUpdateUser(uid) {
  let super_admin, portal_admin, content_creator, portal_user,
    fullname = $("#fullname").val(),
    email = $("#email").val(),
    phone = $("#phone").val(),
    username = $("#username").val(),
    upassword = $("#upassword").val(),
    status = $("#status").val();
  if (fullname === "" || email === "" || phone === "" || username === "") {
    alert("Please fill all the Required fields")
  } else {
    if (!$("#super-admin").is(':checked') && !$("#portal-admin").is(':checked') && !$("#content-creator").is(':checked') && !$("#portal-user").is(':checked')) {
      alert("Please Pick atleast one user Previllege")
    } else {
      if ($("#super-admin").is(':checked')) {
        super_admin = "true";
      } else {
        super_admin = "false";
      }

      if ($("#portal-admin").is(':checked')) {
        portal_admin = "true"
      } else {
        portal_admin = "false"
      }

      if ($("#content-creator").is(':checked')) {
        content_creator = "true"
      } else {
        content_creator = "false"
      }

      if ($("#portal-user").is(':checked')) {
        portal_user = "true"
      } else {
        portal_user = "false"
      }

      $.ajax({
        type: "POST",
        url: "/promotions/admin/update-user",
        data: {
          super_admin, portal_admin, content_creator,
          portal_user, fullname, email, phone, username, upassword, status, uid
        },
        dataType: false,
        contentTye: false,
        cacheData: false,
        beforeSend: () => {
          $("#createuser").html('<img src="/public/images/spinner30pxclear.gif"/>')
        },
        success: (res) => {
          let resdata = JSON.parse(res)
          if (resdata.status === 'success') {
            if (contentLoaded === 'users') {
              loadUsers()
            }
          } else {
            alert(resdata.message)
          }
        },
        error: (err) => {
          alert(err.message)
        }
      })
    }
  }
}



function generatePassword() {
  let pass = generateString(8);
  $("#upassword").val(pass)

}
function generatePass() {
  let pass = generateString(8);
  $("#password").val(pass)
}
