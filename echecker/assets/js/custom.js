
document.onreadystatechange = function () {
    var state = document.readyState
    if (state == 'interactive') {
    } else if (state == 'complete') {
        document.getElementById('interactive');
        $('#loader-background').hide(1100);

    }
}
$(document).ready(function(){
    
    
    
    // CHART DEAN
    if((window.location.pathname == "/echecker/reports" && __userSessionPositionData == '2') || (window.location.pathname == "/echecker/dashboard" && __userSessionPositionData == '2') ){
        $('.report-chart-list').show(1000);
        $('.report-table-list').hide(1500);

        $.ajax({
            url:'reports/reportDepartmentSubjectResultList',
            type:'POST',
            dataType:"json",
            success:function(result){
                
                if(result){
                    
                    var data = {};
                
                    data = {};
                    data.labels = [];
                    data.series = [];
                    data.series[0] = [];

                    for(i=0;i<result.subject.length;i++){
                        data.labels[i] = result.subject[i].subject_code;
                        data.series[0][i] = result.subject[i].passing_rate;
                    }
                    console.log(data);
                    var options = {
                        seriesBarDistance: 10
                        };
                        
                        var responsiveOptions = [
                        ['screen and (min-width: 641px) and (max-width: 1024px)', {
                            seriesBarDistance: 10,
                            axisX: {
                            labelInterpolationFnc: function (value) {
                                return value;
                            }
                            }
                        }],
                        ['screen and (max-width: 640px)', {
                            seriesBarDistance: 5,
                            axisX: {
                            labelInterpolationFnc: function (value) {
                                return value[0];
                            }
                            }
                        }]
                        ];
                        
                        var html = '<span class="brand roboto" style="font-size:16px;margin:50px;margin-bottom:hidden;">PASSING RATE</span>'
                                +'<div class="ct-chart ct-perfect-fourth report-chart-list1" style="max-height:300px;overflow-x:auto;overflow-y:hidden;"></div>';
                        $('.report-charts-section').html(html);
                        new Chartist.Bar('.report-chart-list1', data, options, responsiveOptions);
                

                }else{
                    var data = {
                        labels: ['No Record'],
                          series: [
                          [0]
                          
                        ]
                      };

                      var options = {
                        seriesBarDistance: 10
                      };
                      
                      var responsiveOptions = [
                        ['screen and (min-width: 641px) and (max-width: 1024px)', {
                          seriesBarDistance: 10,
                          axisX: {
                            labelInterpolationFnc: function (value) {
                              return value;
                            }
                          }
                        }],
                        ['screen and (max-width: 640px)', {
                          seriesBarDistance: 5,
                          axisX: {
                            labelInterpolationFnc: function (value) {
                              return value[0];
                            }
                          }
                        }]
                      ];
                      var html = '<div class="ct-chart ct-perfect-fourth report-chart-list" style="height:200px;overflow-x:auto;overflow-y:hidden;"></div>';
                      $('.report-charts-section').append(html);
                      new Chartist.Bar('.report-chart-list', data, options, responsiveOptions);
                }

                
            }
        });
    }
    // CHART DEAN END
    
    // CHART VPAA END
    $(document).on('click','.btn-report-show-departmentlist-table',function(e){
        var btn = $(this);

        if($('.report-chart-list').is(':visible')){
            $('.report-chart-list').hide(1500);
            $('.report-table-list').show(1000);
            btn.children('i').text("keyboard_arrow_down");
            btn.children('span').text("SHOW CHART");
            btn.attr('title','Show Chart');
        }else{
            $('.report-chart-list').show(1000);
            $('.report-table-list').hide(1500);
            btn.children('i').text("keyboard_arrow_up");
            btn.children('span').text("HIDE CHART");
            btn.attr('title','Show Chart');
        }
        
    });

    if((window.location.pathname == "/echecker/reports/reportsdepartmentlist" && __userSessionUserLevelData == '3') || (window.location.pathname == "/echecker/dashboard" && __userSessionUserLevelData == '3') ){
        $('.report-chart-list').show(1000);
        $('.report-table-list').hide();
        $.ajax({
            url:'reports/reportSubjectResultList',
            type:'POST',
            dataType:"json",
            success:function(result){
                if(result){
                    var data = {};
                    for(i=0;i<result.length;i++){
                        data = {};
                        data.labels = [];
                        data.series = [];
                        data.series[0] = [];

                        for(j=0;j<result[i].subject.length;j++){
                            data.labels[j] = result[i].subject[j].subject_code;
                            data.series[0][j] = result[i].subject[j].passing_rate;
                        }

                        var options = {
                            seriesBarDistance: 10
                          };
                          
                          var responsiveOptions = [
                            ['screen and (min-width: 641px) and (max-width: 1024px)', {
                              seriesBarDistance: 10,
                              axisX: {
                                labelInterpolationFnc: function (value) {
                                  return value;
                                }
                              }
                            }],
                            ['screen and (max-width: 640px)', {
                              seriesBarDistance: 5,
                              axisX: {
                                labelInterpolationFnc: function (value) {
                                  return value[0];
                                }
                              }
                            }]
                          ];
                          
                          var html = '<span class="brand roboto" style="font-size:16px;margin:50px;">'+result[i].description+'</span>'
                                    +'<div class="ct-chart ct-perfect-fourth report-chart-list'+i+'" style="height:150px;overflow-x:auto;overflow-y:hidden;"></div>';
                          $('.report-charts-section').append(html);
                          new Chartist.Bar('.report-chart-list'+i+'', data, options, responsiveOptions);
                    }

                }else{
                    var data = {
                        labels: ['No Record'],
                          series: [
                          [0]
                          
                        ]
                      };

                      var options = {
                        seriesBarDistance: 10
                      };
                      
                      var responsiveOptions = [
                        ['screen and (min-width: 641px) and (max-width: 1024px)', {
                          seriesBarDistance: 10,
                          axisX: {
                            labelInterpolationFnc: function (value) {
                              return value;
                            }
                          }
                        }],
                        ['screen and (max-width: 640px)', {
                          seriesBarDistance: 5,
                          axisX: {
                            labelInterpolationFnc: function (value) {
                              return value[0];
                            }
                          }
                        }]
                      ];
                      var html = '<div class="ct-chart ct-perfect-fourth report-chart-list" style="height:200px;overflow-x:auto;overflow-y:hidden;"></div>';
                      $('.report-charts-section').append(html);
                      new Chartist.Bar('.report-chart-list', data, options, responsiveOptions);
                }

                
            }
        });
       
    }
    

    // CHART VPAA END

    // BUTTON SHOW DETAILS MULTIPLE CHOICE
    $(document).on('click','button.btn-multiple-choice-summary',function(e){
        e.preventDefault();
        var btn = $(this);

        if($('div.multiple-choice-summary').hasClass('btn-hidden')){
            $('.btn-multiple-choice-summary-text').text("HIDE SUMMARY");
            btn.children('i').text("ic_keyboard_arrow_up");
            $('div.multiple-choice-summary').removeClass('btn-hidden');
            $('div.multiple-choice-summary').show(1000);
            
            
        }else{
            $('.btn-multiple-choice-summary-text').text("SHOW SUMMARY");
            btn.children('i').text("ic_keyboard_arrow_down");
            $('div.multiple-choice-summary').addClass('btn-hidden');
            $('div.multiple-choice-summary').hide(1000);
        }
        
        
    })
    // BUTTON SHOW DETAILS MULTIPLE CHOICE END

    //TOOL TIP
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        $.material.init();
    })
    

    //TOOL TIP END
    $('.time-hours-minute-duration').durationPicker({
        
          langs: 'en',
        
          formatter: function (s) {
        
            return s;   
        
          },
    
          showDays: false
    
    });

       
    var langs = {
    
        en: {
            hours: 'hours',
            minutes: 'minutes',
        },
    
    };
        


    //*********** LOGIN

    $(document).on('submit','#loginform',function(){
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');
        $.ajax({
            url:url,
            type:type,
            dataType:"json",
            data:form.serialize(),
            success:function(data){
                
                if(data[0]['status'] == 'active' && data[1] == true){
                    document.location.href = '/echecker/dashboard';
                }else if(data[0]['status'] == 'inactive' && data[1] == true){
                    document.location.href = '/echecker/logout/changepassword';
                }else if(data[0]['status'] == 'invalid' && data[1] == true){
                    $('.validation-summary-errors').removeClass('hidden');
                    form.effect('bounce','slow');
                }else if(data[0]['status'] == 'invalid' && data[1] == false){
                    document.location.href = '/echecker/login/registeradmin';
                }
                    
             
            }
        });
    });
    //********* LOGIN END

    //********* PASSWORD VALIDATION

    function checkPasswordComplexity(pwd) {
        var letter = /[a-zA-Z]/; 
        var number = /[0-9]/;
        var valid = number.test(pwd) && letter.test(pwd) && pwd.length > 3;
        return valid;
    }

    //*********** CHANGEPASSWORD
    $(document).on('submit','#form-changepassword',function(){
        
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');
        
        if($('#changepass-newpassword').val() != $('#changepass-renewpassword').val()){
            swal("Invalid", "Password Did not match", "error");
            return false;
        }
        
        if(checkPasswordComplexity($('#changepass-newpassword').val()) == false){
            swal("Invalid", "password must contain atleast 4 alpha numeric characters", "error");
            return false;

        }
        
        $.ajax({
            url:url,
            type:type,
            dataType:"json",
            data:form.serialize(),
            success:function(data){
                if(data != false){
                    swal("Success", "Password Successfully Changed", "success");
                   document.location.href = '/echecker/dashboard';
                }else{
                    $('.validation-summary-errors').removeClass('hidden');
                    form.effect('bounce','slow');
                }
            }
        });
    });
    //********* CHANGEPASSWORD END

    //*********** REGISTER ADMIN
    $(document).on('submit','#form-registeradmin',function(){
        
        if($('#registeradmin-password').val() != $('#registeradmin-confirmpassword').val()){
            swal("Invalid", "Password Did not match", "error");
            return false;
        }
        
        if(checkPasswordComplexity($('#registeradmin-confirmpassword').val()) == false){
            swal("Invalid", "password must contain atleast 4 alpha numeric characters", "error");
            return false;

        }
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');
        
        
        $.ajax({
            url:url,
            type:type,
            dataType:"json",
            data:form.serialize(),
            success:function(data){
                if(data[1] == true){
                    swal("Success", "Welcome Admin !", "success");
                   document.location.href = '/echecker/dashboard';
                }else{
                    $('.validation-summary-errors').removeClass('hidden');
                    form.effect('bounce','slow');
                }
            }
        });
    });
    //********* REGISTER ADMIN END

    //********* SIGN OUT
    $('#btn-signout').on('click',function(){
        document.location.href = 'logout';
    });

    //********* SIGN OUT END
    $(document).on('click','.dropdown-menu.open',function(){
        $(this).toggleClass('open');
    })
     /***************GREETINGS***************/
    var thehours = new Date().getHours();
	var themessage;
	var morning = ('Good Morning');
	var afternoon = ('Good Afternoon');
	var evening = ('Good Evening');

	if (thehours >= 0 && thehours < 12) {
        $('#morning-greetings').removeClass('hidden');
        $('#afternoon-greetings').addClass('hidden');
        $('#evening-greetings').addClass('hidden');
		themessage = morning;

	} else if (thehours >= 12 && thehours < 18) {
        $('#morning-greetings').addClass('hidden');
        $('#afternoon-greetings').removeClass('hidden');
        $('#evening-greetings').addClass('hidden');
		themessage = afternoon;

	} else if (thehours >= 18 && thehours < 24) {
        $('#morning-greetings').addClass('hidden');
        $('#afternoon-greetings').addClass('hidden');
        $('#evening-greetings').removeClass('hidden');
		themessage = evening;
	}

	$('.greeting').append(themessage);
    /***************END GREETINGS***************/
    //******** ETC */
    
        tinymce.init({
             selector: '.mytextarea'
        });
  
   
    //********* DATA TABLES
    $('#table-professorslist').DataTable();
    $('#table-courselist').DataTable();
    $('#table-studentslist').DataTable();
    $('#table-subjectList').DataTable();
    $('#table-departmentlist').DataTable();
    $('#table-scheduleList-main').DataTable();
    $('#table-examinationList').DataTable();
    $('#table-classlist').DataTable();
    
    //********* DATA TABLES END\

    //********* SELECT PICKER
    $(".chzn-select").chosen({width:"80%"});
    //********* SELECT PICKER END
    $('.datepicker-date').bootstrapMaterialDatePicker({
        time:false,
        month:true,
        date:true,
        format: 'MM-DD-YY',
        shortTime:true,
    });
    $('.datepicker-time').bootstrapMaterialDatePicker({
        time:true,
        month:false,
        date:false,
        format: 'HH:mm',
        shortTime:true,
    });
    //********* DATE PICKER
    
    //********* DATE PICKER END
    //$('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
    
    //********* USERLIST
    
    //********* USERLIST END

    //********* BULLETIN
    $(document).on('click','#btn-update-bulletin',function(){
      
        $('#mdl-title').html('Update Message');
        var htmlbody = '<form action="pages/postMessage" method="post" onsubmit="return false;" id="mdl-frm-post-message">'
                        +'<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">Message</div></span>'
                        +'   <field type="text" name="message" class="form-control mytextarea" aria-describedby="basic-addon1" id="" required="required"></field>'
                        +'</div></form>';
        $('.modal-body').html(htmlbody);
        var footer = '<button type="submit" form="mdl-frm-post-message" class="btn btn-primary btn-post-message"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
        tinymce.init({
             selector: '.mytextarea'
        });
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
    });

    $(document).on('submit','#mdl-frm-post-message',function(){
        var frm = $(this);
        var data = frm.serialize();
        var method = frm.attr('method');
        var url = frm.attr('action');
        $.ajax({
            url:url,
            method:method,
            data:data,
            dataType:"json",
            success:function(data){
                if(data == true){
                    swal("Success", "Successfully Changed !.", "success");
                    location.reload();
                }
            }
        });
    });
    //********* BULETIN END

    //********* FILEINPUT
    $("#input-import-users").fileinput({
       
        uploadUrl: "users/importusers",
        allowedFileExtensions: ["xlsx", "xlsm", "xlsb", "xltx", "xltm", "xls"
        , "xlt", "xml" , "xlam" , "xla", "xlw", "xlr", "csv"],
        previewClass: "bg-warning",
        uploadAsync:true,
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" +
            "   <div class=\'input-group-btn\'>\n" +
            "       {browse}\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "</div>"
        },
        uploadExtraData: function (previewId, index) {
            var fieldVal = $('#select-user-imports').val();
            var data = {"userfield": fieldVal};
            return data;
        }
       
    });
    

    
    $(document).on("fileuploaded","#input-import-users",function(event,data,previewId,index){
        if(data.response){
            swal("Success", "Successfully Recorded.", "success");
            location.reload();
            
        }else{
            swal("Error", "Error add Record.", "error");
            return false;
        }

    });
    

    $("#input-import-field").fileinput({
       
        uploadUrl: "imports/importfield",
        allowedFileExtensions: ["xlsx", "xlsm", "xlsb", "xltx", "xltm", "xls"
        , "xlt", "xml" , "xlam" , "xla", "xlw", "xlr", "csv"],
        previewClass: "bg-warning",
        uploadAsync:true,
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" +
            "   <div class=\'input-group-btn\'>\n" +
            "       {browse}\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "</div>"
        },
        uploadExtraData: function (previewId, index) {
            var fieldVal = $('.fieldList').val();
            var data = {"field": fieldVal};
            return data;
        }
       
    });
    
    $(document).on("fileuploaded","#input-import-field",function(event,data,previewId,index){
        
    });


    //USER PROFILE
    $("#upload-user-image-profile").fileinput({
        
         uploadUrl: "profiles/uploadUserImage",
         allowedFileExtensions: ["png","jpg","jpeg"],
         previewClass: "bg-warning",
         uploadAsync:true,
         layoutTemplates: {
             main1: "{preview}\n" +
             "<div class=\'input-group {class}\'>\n" +
             "   <div class=\'input-group-btn\'>\n" +
             "       {browse}\n" +
             "       {upload}\n" +
             "       {remove}\n" +
             "   </div>\n" +
             "   {caption}\n" +
             "</div>"
         },
         /*
         uploadExtraData: function (previewId, index) {
             //var fieldVal = $('#select-user-imports').val();
             //var data = {"userfield": fieldVal};
             //return data;
         }
         */
        
     });
     $(document).on("fileuploaded","#upload-user-image-profile",function(event,data,previewId,index){
        if(data.response){
            console.log(data);
            swal("Success", "Successfully Recorded.", "success");
            location.reload();
            
        }else{
            swal("Error", "Error add Record.", "error");
            return false;
        }

    });
    //********* FILEINPUT END
    
    //********* ADD USER SUBJECT KANBAN

   function kanbanAddUserSubject(userData){
    
    var url = '';
    if(userData.level == "1"){
        url = 'users/getStudentAvailableSubjects';
    }else{
        url = 'users/getTeacherAvailableSubjects';
    }
    $.ajax({
        url:url,
        dataType:"json",
        success:function(data){
            if(data == [] || data == null || data == ""){
                $('div.no-subject-div').show();
            }
            var fields = [
                { name: "id", map: "id", type: "string" },
                { name: "status", map: "state", type: "string" },
                { name: "text", map: "label", type: "string" },
                { name: "tags", type: "string" },
                { name: "color", map: "hex", type: "string" },
                { name: "resourceId", type: "number" }
            ];
            var tmpLocalData = [];
            
            data.forEach(function(input){
                var tmpArray = {id : input.idsubject, state:"availableSubjects", label: input.subject_code+" | " + input.subject_description, tags:[input.schedule_code,input.time_start+"-",input.time_end,input.day]};
                tmpLocalData.push(tmpArray);
               
            });
            var source =
            {
                localData: tmpLocalData,
                dataType: "array",
                dataFields: fields
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var resourcesAdapterFunc = function () {
            var resourcesSource =
            {
                localData: [
                        {},
                        
                ],
                dataType: "array",
                dataFields: [
                        { name: "id", type: "number" },
                        { name: "name", type: "string" },
                        { name: "image", type: "string" },
                        { name: "common", type: "boolean" }
                ]
            };
            var resourcesDataAdapter = new $.jqx.dataAdapter(resourcesSource);
            return resourcesDataAdapter;
            }
            $('#kanban').jqxKanban({
            resources: resourcesAdapterFunc(),
            source: dataAdapter,
            width: '100%',
            height: '100%',
            columns: [
                { text: "Subjects", dataField: "subjectsList" },
                { text: "Available Subjects", dataField: "availableSubjects" },
            ]
            });
            
        }
    });
    
   }
   // UPDATE
   function kanbanUpdateUserSubject(userData){
    var url = '';
    if(userData.level == "2"){
        url = 'users/getTeacherSubjectByUID';
    }else{
        url = 'users/getStudentSubjectByUID';
    }
    $.ajax({
        url:url,
        data:{id:userData.id,idsubject:userData.idSubject},
        method:"POST",
        dataType:"json",
        
        success:function(data){
            if(data == [] || data == null || data == ""){
                $('div.no-subject-div').show();
            }
            var fields = [
                { name: "id", map: "id", type: "string" },
                { name: "status", map: "state", type: "string" },
                { name: "text", map: "label", type: "string" },
                { name: "tags", type: "string" },
                { name: "color", map: "hex", type: "string" },
                { name: "resourceId", type: "number" }
            ];
            var tmpLocalData = [];
            
            if(data){
                data.forEach(function(input){
                    
                    var tmpArray = {id : input.idsubject, state:input.state, label: input.subject_code+" | " + input.subject_description, tags:[input.schedule_code,input.time_start+"-",input.time_end,input.day]};
                    tmpLocalData.push(tmpArray);
                    
                });
            }
            
            var source =
            {
                localData: tmpLocalData,
                dataType: "array",
                dataFields: fields
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var resourcesAdapterFunc = function () {
            var resourcesSource =
            {
                localData: [
                        {},
                        
                ],
                dataType: "array",
                dataFields: [
                        { name: "id", type: "number" },
                        { name: "name", type: "string" },
                        { name: "image", type: "string" },
                        { name: "common", type: "boolean" }
                ]
            };
            var resourcesDataAdapter = new $.jqx.dataAdapter(resourcesSource);
            return resourcesDataAdapter;
            }
            $('#kanban').jqxKanban({
            resources: resourcesAdapterFunc(),
            source: dataAdapter,
            width: '100%',
            height: '100%',
            columns: [
                { text: "Subjects", dataField: "subjectsList" },
                { text: "Available Subjects", dataField: "availableSubjects" },
            ]
            });
            
        }
    });
    
   }

    //********* ADD USER SUBJECT KANBAN END

    //********* ADD USERS \
    $(document).on('click','.btn-add-teacher',function(e){
        e.preventDefault();
        $.ajax({
            url:'users/modalAddTeacher',
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Add User');
                var body = data["body"];
                $('.modal-body').html(body);
                $('.modal-footer').html(data["footer"]);
                $(".chzn-select").chosen({width:"100%",
                        placeholder_text_single: "Select Options...",
                         no_results_text: "Oops, nothing found!"});

                //KANBAN
               
                kanbanAddUserSubject(2);
                // END KANBAN
                
            }   
        });
      
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
        
    });
 
    $(document).on('click','.btn-add-student',function(e){
        e.preventDefault();
        var button = $(this);
        var isAdmin = button.data('isadmin');
        var idSubject = button.data('idsubject');
        $.ajax({
            url:'users/modaladdstudent',
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Add User');
                $('.modal-body').html(data["body"]);
                $('.modal-footer').html(data["footer"]);
                $(".chzn-select").chosen({width:"100%",placeholder_text_single: "Select Project/Initiative...",
      no_results_text: "Oops, nothing found!"});
                //KANBAN
                if(isAdmin == 1){
                    var userData ={
                        'isadmin':1,
                        'level':1
                    };
                    kanbanAddUserSubject(userData);
                }
                
                // END KANBAN
                if($('.input-class-subjectList').val() != null){
                    $('.input-class-subjectList').val(idSubject);
                }
            }
        });
        
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
    });
    
    //********* ADD USERS END
    //********* POST ADD USERS
    $(document).on('submit','.mdl-frm-add-users',function(e){
        e.preventDefault();

        var subjectDataList = $('#kanban').jqxKanban('getItems');
       
        var getClassSubjects = [];
        if(subjectDataList != null){
            subjectDataList.forEach(function(data){
                if(data.status == "subjectsList"){
                    getClassSubjects.push(data.id);
                }
            });
            $('.input-class-subjectList').val(getClassSubjects);
        }

        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
              
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", "User Already exist", "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });
    //********* POST ADD USERS END

    //********* DELETE USER
    
    $(document).on('click','.btn-delete-user',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", "Error Delete Record.", "error");
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //********* DELETE USER END
    //********* UPDATE USER
    $(document).on('click','.btn-update-user',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var user_level = btn.data('level');
        var isAdmin = btn.data('isadmin');
        var idSubject = btn.data('idsubject');
       
        $.ajax({
            url:'users/getuserinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id,user_level:user_level},
            success:function(data){
                $.ajax({
                    url:'users/modalUpdateUser',
                    dataType:"json",
                    method:"POST",
                    data:data,
                    success:function(data){
                        
                        $('#mdl-title').html('Update User');
                        $('.modal-body').html(data["body"]);
                        $('.modal-footer').html(data["footer"]);
                        $(".chzn-select").chosen({width:"100%"});
                            if(isAdmin == "1"){
                                var userData = {
                                    'id':id,
                                    'level':user_level,
                                    'idsubject':idSubject
                                };
                                
                                kanbanUpdateUserSubject(userData);
                            }
                            
                        
                        if($('.input-class-subjectList').val() != null){
                            $('.input-class-subjectList').val(idSubject);
                        }
                    }
                });
            }
        });
    
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
    });

    //********* POST UPDATE USER
    $(document).on('submit','#mdl-frm-update-user',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        var subjectDataList = $('#kanban').jqxKanban('getItems');
        
         var getClassSubjects = [];
         var classSubjectsAvailable = [];
         
         if(subjectDataList != null){
            subjectDataList.forEach(function(data){
                if(data){
                   if(data.status == "subjectsList"){
                       getClassSubjects.push(data.id);
                   }else if(data.status == "availableSubjects"){
                      classSubjectsAvailable.push(data.id);
                   }
                }
            });
            
            $('.input-class-subjectList').val(getClassSubjects);
            $('.input-class-available-subjectList').val(classSubjectsAvailable);
         }

        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                            $('#mdl-user-update').modal('hide');
                        }else{
                            swal("cancelled", "User Username Already Exist.", "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    //********* UPDATE USER END
    
    //******** SCHEDUELES */
    
    
    $(document).on('click','.btn-schedule',function(e){
        e.preventDefault();
        $('#mdl-secondary-title').html('Schedule List');
        var htmlbody = '';
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'schedules/getAllschedules',
            dataType:"json",
            method:"POST",
            success:function(data){
                htmlbody = '<table id="table-schedulelist" class="table table-striped">'
                          +'<thead>'
                          +'<tr>'
                          +'<td class="text-center font-roboto color-a2">CODE</td>'
                          +'<td class="text-center font-roboto color-a2">DAY</td>'
                          +'<td class="text-center font-roboto color-a2">TIME START</td>'
                          +'<td class="text-center font-roboto color-a2">TIME END</td>'
                          +'<td class="text-center font-roboto color-a2">ACTION</td>'
                          +'</tr>'
                          +'</thead>'
                          +'<tbody>';
                data.forEach(function(inputs){
                    var id = inputs['idschedule'];
                    var code = inputs['schedule_code'];
                    var day = inputs['day'];
                    var time_start = inputs['time_start'];
                    var time_end = inputs['time_end'];
                    var status = inputs['status'];

                    if(status == "available"){
                        htmlbody += "<tr>"

                            +"<td class='text-center font-roboto color-a2'>"+code+"</td>"
                            +"<td class='text-center font-roboto color-a2'>"+day+"</td>"
                            +"<td class='text-center font-roboto color-a2'>"+time_start+"</td>"
                            +"<td class='text-center font-roboto color-a2'>"+time_end+"</td>"
                            +"<td class='text-center font-roboto color-a2' style='text-align:center;'>"
                            +"<button data-id='"+id+"' data-code='"+code+"' rel='tooltip' data-original-title='Select' class='pull-right mdl-btn-add-schedule btn btn-success' type='button' name='create'>"
                            +"<i class='material-icons'>add</i>"
                            +"</button>"
                            +"</td>"
                            +"</tr>";   
                    }
                });
                htmlbody+= "</tbody>"
                      +"</table>";
                $('.modal-secondary-body').html(htmlbody);
                
            }
        });
        var footer = '<div style="padding:5px;" class="text-right"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button></div>';
        $('.modal-secondary-footer').html(footer);
        $('#table-scheduleList').DataTable();
        
        $('#modal-dynamic-secondary').modal('show');
        $('.modal-dialog').attr('style','width:100%;height:100%;padding:0 !important;margin:0 !important;left:0');
    });


    $(document).on('click','.mdl-btn-add-schedule',function(e){
        var btn = $(this);
        var id = btn.data('id');
        var code = btn.data('code');
        $('#mdl-input-schedule').val(id);
        $('#mdl-input-temp-schedule').val(code);
        $('#modal-dynamic-secondary').modal('hide');
    });

    //******** SCHEDUELES  END*/
    
    //******** Add Subject */
    $(document).on('click','.btn-add-subject',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add Subject');
        var inputList = ["subject_code","subject_description","units"];
        var classInput = ["input-add-subject-code","input-add-subject-description",""];
        var headerList = ["Subject Code","Subject Description","Units"];
        var htmlbody = '<form action="subjects/addsubject" method="post" onsubmit="return false;" id="mdl-frm-add-subject">';
        i = 0;
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:150px;float:left;">'+upperCaseFirstWord(headerList[i])+'</div></span>'
                        +'   <input type="text" placeholder="Enter '+headerList[i]+'" class="form-control '+classInput[i]+'" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>';
            i++;
        });
        htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:150px;float:left;">Schedule</div></span>'
                        +'   <input type="hidden" id="mdl-input-schedule" class="form-control" name="schedule" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" value="Click to Choose Schedules" id="mdl-input-temp-schedule" class="form-control btn-schedule" name="temp_schedule" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-subject" class="btn btn-primary btn-post-add-subject"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
    
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
        
        
        
           
    });
    //******** ADD SUBJECT END */

    //******** ADD SUBJECT AUTO FILL */
    $(document).on('change','.input-add-subject-code',function(){
        var inputCode = $(this);
        switch(inputCode.val().toLowerCase()) {
            case 'eng+':
            $('.input-add-subject-description').val("Communication Skills");
            break;
            case 'eng1':
            $('.input-add-subject-description').val("Study and Thinking Skills");
            break;
            case 'fil1':
            $('.input-add-subject-description').val("Sining ng Pakikipagtalastasan");
            break;
            case 'comp1':
            $('.input-add-subject-description').val("Computer Fundamentals 1");
            break;
            case 'psych 1':
            $('.input-add-subject-description').val("General Psychology");
            break;
            //1st yr subj
    
            case 'eng2':
            $('.input-add-subject-description').val("Writing in the Discipline");
            break;
            case 'fil2':
            $('.input-add-subject-description').val("Pagbasa at Pagsulat sa Ibat-ibang Displina");
            break;
            case 'it 121':
            $('.input-add-subject-description').val("Computer Fundamentals 2");
            break;
            case 'it 122':
            $('.input-add-subject-description').val("Computer Programming 1");
            break;
            case 'val Ed':
            $('.input-add-subject-description').val("Values Education");
            break;
            // 1st yr 2nd sem
    
            case 'eng 3':
            $('.input-add-subject-description').val("Speech Communication");
            break;
            case 'polsci':
            $('.input-add-subject-description').val("Politics and Governance with Phil. Constitution");
            break;
            case 'econ 1':
            $('.input-add-subject-description').val("Intro to Economics with Land Reform and Taxation");
            break;
            case 'it 211':
            $('.input-add-subject-description').val("Data Structure");
            break;
            case 'it 212':
            $('.input-add-subject-description').val("Computer Programming 2");
            break;
            case 'rizal':
            $('.input-add-subject-description').val("Rizal's life, Works and Writings");
            break;
            // 2nd yr 1st sem
    
            case 'it 221':
            $('.input-add-subject-description').val("Computer Programming 3");
            break;
            case 'soc sci 1':
            $('.input-add-subject-description').val("Society and Culture with Family Planning");
            break;
            case 'philo 1':
            $('.input-add-subject-description').val("Logic");
            break;
            case 'lit 1':
            $('.input-add-subject-description').val("Philippine Literature");
            break;
            case 'hum 1':
            $('.input-add-subject-description').val("Humanities and Arts");
            break;
            //2nd yr 2nd sem
    
            case 'it 311':
            $('.input-add-subject-description').val("Computer Architecture with Assembly Language");
            break;
            case 'it 312':
            $('.input-add-subject-description').val("Computer Network 1");
            break;
            case 'it 313':
            $('.input-add-subject-description').val("Database Management System");
            break;
            case 'it 315':
            $('.input-add-subject-description').val("Project Management");
            break;
            case 'hist':
            $('.input-add-subject-description').val("Philippine History: Roots and Development");
            break;
            // 3rd yr 1st sem
    
            case 'it 321':
            $('.input-add-subject-description').val("Computer Network 2");
            break;
            case 'it 322':
            $('.input-add-subject-description').val("Computer Security");
            break;
            case 'it 323':
            $('.input-add-subject-description').val("Operating System");
            break;
            case 'per pev':
            $('.input-add-subject-description').val("Personality Development");
            break;
            //3rd yr 2nd sem
    
            case 'it 411':
            $('.input-add-subject-description').val("Software Engineering");
            break;
            case 'it 412':
            $('.input-add-subject-description').val("Capstone 2: Implementation");
            break;
            case 'it 415':
            $('.input-add-subject-description').val("Free Elective 1");
            break;
            case 'it 416':
            $('.input-add-subject-description').val("Free Elective 2");
            break;
            //4th yr 1st sem
    
            case 'it 421':
            $('.input-add-subject-description').val("Entrepreneurship");
            break;
            case 'it 321':
            $('.input-add-subject-description').val("IT Elective 3");
            break;
            case 'it 424':
            $('.input-add-subject-description').val("IT Elective 4");
            break;
            case 'it 425':
            $('.input-add-subject-description').val("Free Elective 2");
            break;
            case 'it 426':
            $('.input-add-subject-description').val("Free Elective 3");
            break;
            //4th yr 2nd sem
    
    
            //Computer Science 1st yr 1st Sem
            case 'eng1':
            $('.input-add-subject-description').val("Study and Thinking Skills");
            break;
            case 'fil1':
            $('.input-add-subject-description').val("Sining ng Pakikipagtalastasan");
            break;
            case 'psych 1':
            $('.input-add-subject-description').val("General Psychology");
            break;
            case 'comp 1':
            $('.input-add-subject-description').val("Computer Fundamentals 1");
            break;
            
            //Computer Science 1st yr 2nd Sem 
            case 'cs 121':
            $('.input-add-subject-description').val("Computer Fundamentals 2");
            break;
            case 'cs 122':
            $('.input-add-subject-description').val("Computer Programming 1");
            break;
            case 'fil 2':
            $('.input-add-subject-description').val("Pagbasa at Pagsulat sa Iba't-ibang Disiplina");
            break;
            case 'val ed':
            $('.input-add-subject-description').val("Values Education");
            break;
    
            // 2nd yr 1st sem
            case 'math 4b':
            $('.input-add-subject-description').val("Calculus");
            break;
            case 'cs 211':
            $('.input-add-subject-description').val("Data Structure");
            break;
            case 'cs 212':
            $('.input-add-subject-description').val("Computer Programming 2");
            break;
            case 'rizal':
            $('.input-add-subject-description').val("Rizal's life, Works and Writings");
            break;
            case 'eng 3':
            $('.input-add-subject-description').val("Speech Communication");
            break;
    
            // 2nd yr 2nd sem
            case 'philo 1':
            $('.input-add-subject-description').val("Logic");
            break;
            case 'hum 1':
            $('.input-add-subject-description').val("Humanities and Arts");
            break;
            case 'soc sci 1':
            $('.input-add-subject-description').val("Society and Culture with Family Planning");
            break;
            case 'cs 221':
            $('.input-add-subject-description').val("Automata and Formal Language");
            break;
            case 'cs 222':
            $('.input-add-subject-description').val("Computer Programming 3");
            break;
            case 'css':
            $('.input-add-subject-description').val("Computer System Organiztion");
            break;
    
            // 3rd yr 1st sem
            case 'polsci':
            $('.input-add-subject-description').val("Politics and Governance with Phil. Constitution");
            break;
            case 'hist':
            $('.input-add-subject-description').val("Philippine History: Roots and Development");
            break;
            case 'cs 311':
            $('.input-add-subject-description').val("Computer Architecture with Assembly");
            break;
            case 'cs 312':
            $('.input-add-subject-description').val("Data Communications and Networking");
            break;
            case 'cs 313':
            $('.input-add-subject-description').val("Database Management System");
            break;
            case 'cs 314':
            $('.input-add-subject-description').val("Programming Languages");
            break;
            case 'cs 315':
            $('.input-add-subject-description').val("Professional Ethics");
            break;
    
            // 3rd yr 2nd sem
            case 'cs 321':
            $('.input-add-subject-description').val("Logic Design an Switching Theory");
            break;
            case 'cs 322':
            $('.input-add-subject-description').val("Operating System");
            break;
            case 'cs 323':
            $('.input-add-subject-description').val("Software Engineering");
            break;
            case 'cs 324':
            $('.input-add-subject-description').val("System Analysis and Design");
            break;
            case 'cs 325':
            $('.input-add-subject-description').val("Web Programming");
            break;
            case 'cs 326':
            $('.input-add-subject-description').val("Thesis 1");
            break;
            case 'per dev':
            $('.input-add-subject-description').val("Personality Development");
            break;
    
            //4th yr 1st sem
            case 'cs 411':
            $('.input-add-subject-description').val("Free Elective 1");
            break;
            case 'cs 412':
            $('.input-add-subject-description').val("Free Elective 2");
            break;
            case 'cs 413':
            $('.input-add-subject-description').val("CS Elective 1");
            break;
            case 'cs 414':
            $('.input-add-subject-description').val("CS Elective 2");
            break;
            case 'cs 415':
            $('.input-add-subject-description').val("Thesis 2");
            break;
    
            //4th yr 2st sem
            case 'cs 421':
            $('.input-add-subject-description').val("Computer Simulation");
            break;
            case 'mc 107':
            $('.input-add-subject-description').val("Principles of Marketing and Advertising");
            break;
            case 'cs 422':
            $('.input-add-subject-description').val("Free Elective 3");
            break;
            case 'cs 423':
            $('.input-add-subject-description').val("CS Elective 3");
            break;
            case 'cs 424':
            $('.input-add-subject-description').val("CS Elective 4");
            break;
    
            //College of LAW 1st yr 1st sem
    
            case 'ls 101':
            $('.input-add-subject-description').val("Persons & Family Relations");
            break;
            case 'ls 103':
            $('.input-add-subject-description').val("Constitutional Law I");
            break;
            case 'ls 105':
            $('.input-add-subject-description').val("Criminal Law I");
            break;
            case 'ls 107':
            $('.input-add-subject-description').val("Legal Profession/Legal Philo/Intro to Law");
            break;
            case 'ls 109':
            $('.input-add-subject-description').val("Legal Research");
            break;
            case 'ls 111':
            $('.input-add-subject-description').val("Legal Writing");
            break;
            case 'ls 113':
            $('.input-add-subject-description').val("Statutory Construction");
            break;
            case 'ls lec':
            $('.input-add-subject-description').val("Language Enhancement Course");
            break;
    
            //2nd sem
            case 'ls 102':
            $('.input-add-subject-description').val("Obligations & Contracts");
            break;
            case 'ls 104':
            $('.input-add-subject-description').val("Constitutional Law II");
            break;
            case 'ls 106':
            $('.input-add-subject-description').val("Criminal Law II");
            break;
            case 'ls 108':
            $('.input-add-subject-description').val("Legal Tech & Logic");
            break;
            case 'ls 110':
            $('.input-add-subject-description').val("Basic Legal Ethics");
            break;
            case 'ls 112':
            $('.input-add-subject-description').val("Legal Philosophy");
            break;
            case 'ls 114':
            $('.input-add-subject-description').val("Intro to Sharia Law");
            break;
    
        };
    });
    //******** ADD SUBJECT AUTO FILL END */

    //******** POST ADD SUBJECT */
    $(document).on('submit','#mdl-frm-add-subject',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });

    //******** POST ADD SUBJECT END*/

    //******** UPPERCASE*/
    function upperCaseFirstWord(str) {
        var splitStr = str.toLowerCase().split(' ');
        for (var i = 0; i < splitStr.length; i++) {
            
            splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
        }

        return splitStr.join(' '); 
    }
    //******** UPPERCASE END*/

    //******** UPDATE SUBJECT*/
    $(document).on('click','.btn-update-subject',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'subjects/getsubjectinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){
                if(data[1] == true){
                    $('#mdl-title').html('Update Subject');
                    var inputList = ["subject_code","subject_description","units"];
                    var headerList = ["Subject Code","Subject Description","Units"];
                    var htmlbody = '<form action="subjects/updatesubject" method="POST" id="mdl-frm-update-subject" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['idsubject']+'" name="idsubject">';
                    i = 0;
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:150px;float:left;">'+upperCaseFirstWord(headerList[i])+'</div></span>'
                                +'   <input type="text" placeholder="Enter '+headerList[i]+'" class="form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>';
                        i++;
                    });
                    htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:150px;float:left;">Schedule</div></span>'
                        +'   <input type="hidden" value="'+data[0]["idschedule"]+'" id="mdl-input-schedule" class="form-control btn-schedule" name="schedule" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" value="'+data[0]["schedule_code"]+'" id="mdl-input-temp-schedule" class="form-control btn-schedule" name="temp_schedule" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-subject" class="btn btn-primary btn-post-user-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
    });
    
    //******** UPDATE SUBJECT END*/

    //******** POST UPDATE SUBJECT*/

    $(document).on('submit','#mdl-frm-update-subject',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                            $('#mdl-user-update').modal('hide');
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    //******** POST UPDATE SUBJECT END*/

    //******** POST DELETE SUBJECT*/

    $(document).on('click','.btn-delete-subject',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                method:"POST",
                dataType:"json",
                
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE SUBJECT END*/
    
    //******** ADD DEPARTMENT */
    $(document).on('click','.btn-add-department',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add Program');
        var inputList = ["department name","Description"];
        var headerList = ["Program Code","Program Description"];
        var htmlbody = '<form action="departments/adddepartment" method="post" onsubmit="return false;" id="mdl-frm-add-department">';
        i = 0;
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:150px;float:left !important;">'+upperCaseFirstWord(headerList[i])+'</div></span>'
                        +'   <input type="text" placeholder="Enter '+headerList[i]+'" class="program-input'+i+' form-control" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>';
            i++;
        });
        htmlbody += '</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-department" class="btn btn-primary btn-post-add-department"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
        $(document).on('change','input.program-input0',function(){
            var inputCode = $(this);
            switch(inputCode.val().toLowerCase()){
                case 'te':
                $('input.program-input1').val("College of Teachers Education");
                break;
                case 'case':
                $('input.program-input1').val("College of Arts and Sciences Education");
                break;
                case 'cbe':
                $('input.program-input1').val("College of Business Education");
                break;
                case 'cite':
                $('input.program-input1').val("College of Information Technology Education");
                break;
                case 'cee':
                $('input.program-input1').val("College of Engineering Education");
                break;
                case 'cce':
                $('input.program-input1').val("College of Criminal Justice Education");
                break;
                
            };
            
        });
    });
    
    //******** ADD DEPARTMENT END*/

    //******** POST ADD DEPARTMENT */
    $(document).on('submit','#mdl-frm-add-department',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });

    //******** POST ADD DEPARTMENT END*/



    //******** UPDATE DEPARTMENT*/
    $(document).on('click','.btn-update-department',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'departments/getdepartmentinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){
                if(data[1] == true){
                    $('#mdl-title').html('Update College Department');
                    var inputList = ["department_name","description"];
                    var headerList = ["Program Code","Program Description"];
                    var htmlbody = '<form action="departments/updatedepartment" method="POST" id="mdl-frm-update-department" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['iddepartment']+'" name="iddepartment">';
                    i = 0;
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:150px;float:left;">'+upperCaseFirstWord(headerList[i])+'</div></span>'
                                +'   <input type="text" placeholder="Enter '+headerList[i]+'" class="program-input'+i+' form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>'
                        i++;
                    });
                    htmlbody += '</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-department" class="btn btn-primary btn-post-department-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
        $(document).on('change','input.program-input0',function(){
            var inputCode = $(this);
            switch(inputCode.val().toLowerCase()){
                case 'te':
                $('input.program-input1').val("College of Teachers Education");
                break;
                case 'case':
                $('input.program-input1').val("College of Arts and Sciences Education");
                break;
                case 'cbe':
                $('input.program-input1').val("College of Business Education");
                break;
                case 'cite':
                $('input.program-input1').val("College of Information Technology Education");
                break;
                case 'cee':
                $('input.program-input1').val("College of Engineering Education");
                break;
                case 'cce':
                $('input.program-input1').val("College of Criminology Education");
                break;
                
            };

        });
    });

    //******** UPDATE DEPARTMENT END*/

    //******** POST UPDATE DEPARTMENT*/

    $(document).on('submit','#mdl-frm-update-department',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    //******** POST UPDATE DEPARTMENT END*/


    //******** POST DELETE DEPARTMENT*/

    $(document).on('click','.btn-delete-department',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE DEPARTMENT END*/

    //******** ADD COURSE */
    $(document).on('click','.btn-add-course',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add course');
        var inputList = ["course_name","course_description"];
        var classInput = ["input-add-course-code","input-add-course-description"];
        var headerList = ["Course Code","Course Description"];
        var htmlbody = '<form action="courses/addcourse" method="post" onsubmit="return false;" id="mdl-frm-add-course">';
        i=0;
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:150px;float:left;">'+upperCaseFirstWord(headerList[i])+'</div></span>'
                        +'   <input type="text" placeholder="Enter '+headerList[i]+'" class="'+classInput[i]+' form-control" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>';
            i++;
        });
        htmlbody += '</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-course" class="btn btn-primary btn-post-add-course"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
    
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
        $(document).on('change','.input-add-course-code',function(){
                var inputCode = $(this);
                switch(inputCode.val().toLowerCase()) {
                    case 'bsit':
                    $('.input-add-course-description').val("Bachelor of Science in Information Technology");
                    break;
                case 'bsce':
                    $('.input-add-course-description').val("Bachelor of Science in Civil Engineering");
                    break;
                case 'bsp':
                    $('.input-add-course-description').val("Bachelor of Science in Psychology");
                    break;
                case 'bsa':
                    $('.input-add-course-description').val("Bachelor of Science in Accountancy");
                    break;
                case 'bssw':
                    $('.input-add-course-description').val("Bachelor of Science in Social Work");
                    break;
                case 'bsed':
                    $('.input-add-course-description').val("Bachelor of Secondary Education");
                    break;
                case 'beed':
                    $('.input-add-course-description').val("Bachelor of Elementary Education");
                    break;
                case 'bac':
                    $('.input-add-course-description').val("Bachelor of Arts in Communication");
                    break;
                case 'bsba':
                    $('.input-add-course-description').val("Bachelor of Science in Business Administration");
                    break;
                case 'bsc':
                    $('.input-add-course-description').val("Bachelor of Science in Criminology");
                    break;
                case 'bscs':
                    $('.input-add-course-description').val("Bachelor of Science in Computer Science");
                    break;
            };
        });
    });

    //******** ADD COURSE END*/

    //******** POST ADD COURSE */
    $(document).on('submit','#mdl-frm-add-course',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });

    //******** POST ADD COURSE END*/


    //******** UPDATE COURSE*/
    $(document).on('click','.btn-update-course',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'courses/getcourseinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){
                if(data[1] == true){
                    $('#mdl-title').html('Update course');
                    var inputList = ["course_name","course_description"];
                    var headerList = ["Course Code","Course Description"];
                    var htmlbody = '<form action="courses/updatecourse" method="POST" id="mdl-frm-update-course" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['idcourse']+'" name="idcourse">';
                    i=0;
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:150px;float:left;">'+upperCaseFirstWord(headerList[i])+'</div></span>'
                                +'   <input type="text" placeholder="Enter '+headerList[i]+'" class="form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>';
                        i++;
                    });
                    htmlbody += '</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-course" class="btn btn-primary btn-post-course-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
        $('.modal-dialog').attr('style','width:70%;');
    });

    //******** UPDATE COURSE END*/

    //******** POST UPDATE COURSE*/

    $(document).on('submit','#mdl-frm-update-course',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });
    //******** POST UPDATE COURSE END*/

    //******** POST DELETE COURSE*/

    $(document).on('click','.btn-delete-course',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE COURSE END*/
$('#selectpicker').on('hide.bs.dropdown', function () {
    
})
    
    //******** ADD SCHEDULE*/
    
    $(document).on('click','.btn-add-schedule',function(e){
        e.preventDefault();
        $.ajax({
            url:'schedules/modaladdshedule',
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Add Schedule');
                $('.modal-body').html(data["body"]);
                $('.modal-footer').html(data["footer"]);
                $('.datepicker').bootstrapMaterialDatePicker({
                        time:true,
                        month:false,
                        date:false,
                        format: 'HH:mm',
                        shortTime:true,
                });
                $(".chzn-select").chosen({width:"100%",placeholder_text_single: "Select Options...",
      no_results_text: "Oops, nothing found!"});
                $('#modal-dynamic').modal('show');
            }
        });
        
    });

    //******** ADD SCHEDULE END*/
    
    //******** POST ADD SCHEDULE*/
    $(document).on('submit','#mdl-frm-add-schedule',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });
    //******** POST ADD SCHEDULE END*/

    //******** POST DELETE SCHEDULE */
    $(document).on('click','.btn-delete-schedule',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
    });
    //******** POST DELETE SCHEDULE END*/


    //******** UPDATE SCHEDULE */
    $(document).on('click','.btn-update-schedule',function(e){
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            data:{id:id},
            url:'schedules/modalupdateschedule',
            method:"post",
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Update Schedule');
                $('.modal-body').html(data["body"]);
                $('.modal-footer').html(data["footer"]);
                $('.datepicker').bootstrapMaterialDatePicker({
                        time:true,
                        month:false,
                        date:false,
                        format: 'HH:mm',
                        shortTime:true,
                     
                });
                $(".chzn-select").chosen({width:"100%"});
                $('#modal-dynamic').modal('show');
            }
        }); 
      
    });

    //******** UPDATE SCHEDULE END*/
    //******** POST UPDATE SCHEDULE*/
    $(document).on('submit','#mdl-frm-update-schedule',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });
    //******** POST UPDATE SCHEDULE END*/


    
    //******** MODAL ADD CLASS SUBJECT TABLE*/
    $(document).on('click','.btn-classes-subject',function(e){
        e.preventDefault();
        $('#mdl-secondary-title').html('Subject List');
        var htmlbody = '';
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'subjects/getallsubjectlist',
            dataType:"json",
            method:"POST",
            success:function(data){
                htmlbody = '<table id="table-classes-subjectlist" class="table table-striped">'
                          +'<thead>'
                          +'<tr>'
                          +'<td class="text-center font-roboto color-a2">ID</td>'
                          +'<td class="text-center font-roboto color-a2">CODE</td>'
                          +'<td class="text-center font-roboto color-a2">DESCRIPTION</td>'
                          +'<td class="text-center font-roboto color-a2">SCHEDULE</td>'
                          +'<td class="text-center font-roboto color-a2">TIME</td>'
                          +'<td class="text-center font-roboto color-a2">UNITS</td>'
                          +'<td class="text-center font-roboto color-a2">ACTION</td>'
                          +'</tr>'
                          +'</thead>'
                          +'<tbody>';
                data.forEach(function(inputs){
                   
                    var id = inputs['idsubject'];
                    var code = inputs['subject_code'];
                    var description = inputs['subject_description'];
                    var schedule = inputs['day'];
                    var units = inputs['units'];
                    var time = inputs['time_start'];
               
                    htmlbody += "<tr>"
                        +"<td class='text-center font-roboto color-a2'>"+id+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+code+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+description+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+schedule+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+time+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+units+"</td>"
                        +"<td class='text-center font-roboto color-a2' style='text-align:center;'>"
                        +"<button data-id='"+id+"' data-code='"+code+"' rel='tooltip' data-original-title='Select' class='pull-right mdl-btn-add-classes-subject btn btn-success' type='button' name='create'>"
                        +"<i class='material-icons'>add</i>"
                        +"</button>"
                        +"<button data-id='"+id+"' data-code='"+code+"' rel='tooltip' data-original-title='View' class='pull-right mdl-btn-view-classes-subject btn btn-success' type='button' name='create'>"
                        +"<i class='material-icons'>remove_red_eye</i>"
                        +"</button>"
                        +"</td>"
                        +"</tr>";
                           
                    
                });
                htmlbody+= "</tbody>"
                      +"</table><div id='view-subject-users'></div>";
                $('.modal-secondary-body').html(htmlbody);
            }
        });
        var footer = '<div style="padding:5px;" class="text-right"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button></div>';
        $('.modal-secondary-footer').html(footer);
        $('#table-classes-subjectList').DataTable();
    
        $('#modal-dynamic-secondary').modal('show');
    });


    $(document).on('click','.mdl-btn-add-classes-subject',function(e){
        var btn = $(this);
        var id = btn.data('id');
        var code = btn.data('code');
        $('#mdl-input-classes-subject').val(id);
        $('#mdl-input-temp-classes-subject').val(code);
        $('#modal-dynamic-secondary').modal('hide');
    });
    //******** MODAL ADD CLASS SUBJECT TABLE END*/

    //******** MODAL VIEW CLASS SUBJECT TABLE */
    //back to subject list button
    $(document).on('click','.btn-view-class-subject-return',function(e){
        e.preventDefault();
        $('#table-classes-subjectlist').attr('style','display:block !important;');
        $('#view-subject-users').attr('style','display:none !important;');
        $('.modal-dialog').attr('style','width:660px !important;');
    });
    //
    $(document).on('click','.mdl-btn-view-classes-subject',function(e){
        e.preventDefault();

        $('#mdl-secondary-title').html('Subject Information');
        $('#view-subject-users').attr('style','display:block !important;');
        $('.modal-dialog').attr('style','width:80% !important;');
        var htmlbody = '';
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        
        $.ajax({
            url:'subjects/getallsubjectusersbyid',
            dataType:"json",
            data:{id:id},
            method:"POST",
            success:function(data){
                
            if(data != false){
                var teacherName = "";
                data.forEach(function(inputs){
                    if(inputs["user_level"] == "2"){
                        teacherName = inputs["lastname"]+", "+inputs["firstname"]+" "+inputs["middlename"];
                    }
                });
                
                htmlbody = '<div class="row margin5"><div class="roboto col-md-1">Code</div><div class="col-md-11">'+data[0]['subject_code']+'</div></div>'
                +'<div class="row margin5"><div class="roboto col-md-1">Description</div><div class="col-md-11">'+data[0]['subject_description']+'</div></div>'
                +'<div class="row margin5"><div class="roboto col-md-1">Day</div><div class="col-md-11">'+data[0]['day']+'</div></div>'
                +'<div class="row margin5"><div class="roboto col-md-1">Time</div><div class="col-md-11">'+data[0]['time_start']+'-'+data[0]['time_end']+'</div></div>'
                +'<div class="row margin5"><div class="roboto col-md-1">Units</div><div class="col-md-11">'+data[0]['units']+'</div></div>'
                +'<div class="row margin5"><div class="roboto col-md-1">Teacher</div><div class="col-md-11">'+teacherName+'</div></div>'
                //+'<button class="btn btn-sucess pull-right btn-view-class-subject-return">Back</button>'
                +'<h4 class="margin5 roboto col-md-3" style="margin-top:50px;">Student List:</h4>'
                +'<table id="table-classes-subjectlist" class="table table-striped">'
                +'<thead>'
                +'<tr>'
                +'<td class="text-center font-roboto color-a2">CODE</td>'
                +'<td class="text-center font-roboto color-a2">NAME</td>'
                +'<td class="text-center font-roboto color-a2">COURSE</td>'
                +'<td class="text-center font-roboto color-a2">YEAR LEVEL</td>'
                +'<td class="text-center font-roboto color-a2">PROGRAM</td>'
                +'</tr>'
                +'</thead>'
                +'<tbody>';

                data.forEach(function(inputs){
                    
                        var id = inputs['id'];
                        var code = inputs['code'];
                        var firstname = inputs['firstname'];
                        var lastname = inputs['lastname'];
                        var middlename = inputs['middlename'];
                        var course = inputs['course_name'];
                        var year_level = inputs['year_level'];
                        var department = inputs['department_name'];
                   
                          if(inputs['user_level'] == "1"){  
                              htmlbody += "<tr>"
                            
                              +"<td class='text-center font-roboto color-a2'>"+code+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+lastname+", "+firstname+" "+middlename+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+course+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+year_level+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+department+"</td>"
                              +"<td class='text-center font-roboto color-a2' style='text-align:center;'>"
                              +"</td>"
                              +"</tr>";
                          }
                      
                    });
            }else{
                swal("Failed", "There are no existing user on this subject yet.", "error");
            }
            htmlbody+= "</tbody>"
                    +"</table>";
                $('.modal-secondary-body').html(htmlbody);
            }
        });
        var footer = '<div style="padding:5px;" class="text-right"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button></div>';
        $('.modal-secondary-footer').html(footer);

        $('#modal-dynamic-secondary').modal('show');
    });

    //******** MODAL VIEW CLASS SUBJECT TABLE END*/
    
    //******** ADD CLASS*/
    $(document).on('click','.btn-add-classes-subject',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add Class');
        var inputList = ["class_name","class_description","room_name"];
        var htmlbody = '<form action="classes/addclasses" method="post" onsubmit="return false;" id="mdl-frm-add-classes-subject">';
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                        +'   <input type="text" class="form-control" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>'
        });
        htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:100px;float:left;">Subject</div></span>'
                        +'   <input type="hidden" id="mdl-input-classes-subject" class="form-control" name="idsubject" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" id="mdl-input-temp-classes-subject" class="form-control btn-classes-subject" name="tmp_idsubject" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-classes-subject" class="btn btn-primary btn-post-add-classes-subject"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
    
        $('#modal-dynamic').modal('show');
    });

    //******** ADD CLASS END*/

    //******** POST ADD CLASS*/
    $(document).on('submit','#mdl-frm-add-classes-subject',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });
    //******** POST ADD CLASS END*/

    //******** POST DELETE CLASS*/
    $(document).on('click','.btn-delete-class-subject',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE CLASS END*/

    //********  UPDATE CLASS */
    
    $(document).on('click','.btn-update-class',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'classes/getClassesInfoById',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){

                if(data[1] == true){
                    $('#mdl-title').html('Update classes');
                    var inputList = ["class_name","class_description","room_name"];

                    var htmlbody = '<form action="classes/updateclasses" method="POST" id="mdl-frm-update-classes" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['idclass']+'" name="idclass">';
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                                +'   <input type="text" class="form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>'
                    });
                    htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:100px;float:left;">Subject</div></span>'
                        +'   <input type="hidden" value="'+data[0]["idsubject"]+'" id="mdl-input-classes-subject" class="form-control btn-classes" name="idsubject" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" value="'+data[0]["subject_code"]+'" id="mdl-input-temp-classes-subject" class="form-control btn-classes-subject" name="temp_classes" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-classes" class="btn btn-primary btn-post-classes-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
    });
    
    //******** UPDATE CLASS END*/

    //******** POST UPDATE CLASSES*/

    $(document).on('submit','#mdl-frm-update-classes',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                            $('#mdl-classes-update').modal('hide');
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    
    //********  ADD QUESTIONAIRE TYPE */
    
    $(document).on('click','.btn-add-question-type',function(e){
        e.preventDefault();
        
        if($('#questionnaire-add-title').val() == "" || $('#questionnaire-add-description').val() == "" || $('#questionnaire-add-day').val() == "" || $('#questionnaire-add-time').val() == "" || $('#questionnaire-add-duration').val() == "" || $('#questionnaire-add-instruction').val() == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }
        var inputType= document.getElementById('select-question-type-input');
        var inputTitle = document.getElementById('category-title-input');
        var inputAnswerQuantity = document.getElementById('questionaire-case-input');
        var inputNumberOfPoints = document.getElementById('number-of-points-input');
        var inputNumerOfItems = document.getElementById('number-of-items-input');
        var inputTypeValue = inputType.value;
        var inputTypeText = $('#select-question-type-input option:selected').text();
        if(inputAnswerQuantity != null){
            var inputAnswerQuantityValue = inputAnswerQuantity.value;
        }else{
            var inputAnswerQuantityValue = "";
        }
        var inputTitleValue = inputTitle.value;
        var inputNumberOfPointsValue = inputNumberOfPoints.value;
        var inputNumerOfItemsValue = inputNumerOfItems.value;
        var panelQuantity = $('#tab-header > li').length;
        var totalPointsValue = $('#total-points-input').val();

        if( inputAnswerQuantityValue == ""){
            if(inputTypeValue == 0){
                swal("Cancelled", "Fill Up Fields.", "error");
                return false;
            }
        }    
        if( inputTitleValue == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }    
        if(inputNumberOfPointsValue == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }    
        if(inputNumerOfItemsValue == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }
        
        var nextTab = $('#tab-header li').length-1;

        var tabHeader = '<li role="presentation" class="" id="tab-header-add-question'+nextTab+'" style="width:20%;" data-id="'+nextTab+'">'
                            +'<a href="#tab-add-question'+nextTab+'" data-toggle="tab">'
                                +'<span class="">'+inputTitleValue+' - '+inputTypeText+'</span>'
                            +'</a>'
                        +'</li>';
        var tabContent = '<div role="tabpanel" class="tab-pane fade" id="tab-add-question'+nextTab+'" data-id="'+nextTab+'" data-questiontype="'+inputTypeValue+'">'
                        +'<div class="container">'
                        +'<div class="row">'
                        +'<input type="hidden" id="idcategory-tabNo'+nextTab+'" value="">'
                        +'<input type="hidden" id="category-title-tabNo'+nextTab+'" value="'+inputTitleValue+'">'
                        +'<input type="hidden" id="question-quantity-tabNo'+nextTab+'" value="'+inputAnswerQuantityValue+'">'
                        +'<input type="hidden" readonly="readonly" id="item-points-tabNo'+nextTab+'" value="'+inputNumberOfPointsValue+'">'
                        +'<input type="hidden" id="item-quantity-tabNo'+nextTab+'" value="'+inputNumerOfItemsValue+'">'
                        +'<input type="hidden" readonly="readonly" id="total-item-tabNo'+nextTab+'" value="'+totalPointsValue+'">'
                        
                        +'<div class="col-md-10 bhoechie-tab-container template'+nextTab+'">'
                            +'<div class="col-md-2 bhoechie-tab-menu template'+nextTab+'">'
                                +'<div class="list-group" style="max-height:750px;overflow-y:scroll;overflow-x:hidden;">';
                               
        for(i=0;i<inputNumerOfItemsValue;i++){
            tabContent += '<a href="#" class="list-group-item '+((i==0) ? 'active':'')+' text-center">'
                            +'<h4 class="glyphicon glyphicon-tags"></h4><br/><b>'+(i+1)+'</b>'
                        +'</a>';
        }
                                
        tabContent += '</div>'
                        +'</div>'
                        +'<div class="col-md-8 bhoechie-tab">';
                        
        for(i=0;i<inputNumerOfItemsValue;i++){
            tabContent += '<div class="bhoechie-tab-content '+((i==0) ? 'active':'')+'">'
                +'<center id="add-answer'+nextTab+'-'+i+'">'
                    //content
                    
                    +'<div class="col-md-12" style="margin: 5px;">'
                            +'<h1 class="glyphicon glyphicon-question-sign" style="font-size:4em;color:#55518a"></h1>'
                            +'<h2 style="margin-top: 0;color:#55518a">Question no. '+(i+1)+'</h2>'
                            +'<div class="form-group col-md-12">'
                                +'<label style="font-size:16px;">Question</label>'
                                +'<div class="form-group label-floating col-md-12">'
                                    +'<label class="control-label col-md-3" style="left:0;">Write Your Question Here  . . .</label>'
                                    +'<textarea value="" name="question'+i+'" class="col-md-9 form-control mytextarea" id="questionTabno'+nextTab+'-itemno-'+i+'" rows="5"></textarea>'
                                +'</div>'
                                +'<input type="hidden" readonly="readonly" id="idquestionTabno-tabNo'+nextTab+'-itemno-'+i+'" value="">'
                            +'</div>';
            
            if(inputTypeValue != 0){
                tabContent += '<div class="add-answer">'
                    +'<span class="span-add-answer'+nextTab+'"><button class="btn-success btn pull-left btn-add-answer">'
                        +'<span class="material-icons">add</span>'
                    +'</button></span>'
                    +'<span style="margin-top:15px;" class="pull-left">Add Answer . . .</span>'
                +'</div>';
            }                
                tabContent +='</div>';
            if(inputTypeValue == 0){
                for(j=0;j<inputAnswerQuantityValue;j++){
                    tabContent += '<input type="hidden" readonly="readonly" id="idchoicestabNo'+nextTab+'-itemno-'+i+'choicesno-'+j+'" value="">' 
                                    +'<div class="input-group">'
                                    +'<span class="input-group-addon" id="basic-addon1">Answer no'+(j+1)+'</span>'
                                    +'<input type="text" value="" class="form-control use" placeholder="Enter Answer Choices '+(j+1)+'" aria-describedby="basic-addon1" id="choicesTabno-'+nextTab+'-itemno-'+i+'-choicesno-'+j+'" name="choices" data-testno="">'
                                +'</div>';
                }
                   tabContent += '<input type="hidden" readonly="readonly" id="idanswertabNo'+nextTab+'-itemno-'+i+'answerno-0" value="">' 
                +'<div class="form-group">'
                +'<label for="">Select Question Answer</label>'
                    +'<select multiple value="" name="answer" class="form-control" id="answerTabno-'+nextTab+'-itemno-'+i+'-answerno-0" data-testno="">';//tabno-'+nextTab+'-itemno-'+itemNo+'-answerno-'+answerQuantity+'
                for(j=0;j<inputAnswerQuantityValue;j++){
                    
                    tabContent += '<option value="'+j+'">Choices No '+(j+1)+'</option>';
                }    
                    tabContent +='</select>'    
                        +'</div>';
                
            }
            tabContent += '<span class="span-next-item'+nextTab+' item-'+i+'">'
                            +'<button class="btn-success btn pull-right btn-next-item item-'+i+'">'
                                +'<span class="material-icons">playlist_add_check</span>'
                            +'</button>'
                        +'</span>';
                    //content end
            tabContent += '</center>'
            +'</div>';
        }
                                
        tabContent += '</div>'
                        +'</div>'
                        +'</div>'
                        +'</div>';
        // create the tab
        $(tabHeader).appendTo('#tab-header');
        
        // create the tab content
        $(tabContent).appendTo('#tab-content');
        
        // make the new tab active
        
        $('#tab-header a:last').tab('show');
        
       /*
        $(document).on('click','div.bhoechie-tab-content.active span.span-next-item'+nextTab+' > button.btn-next-item'+nextTab+'',function(e){
            var button = $(this);
            var spanNext = button.parent();
            var resultInput = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active input[required]').filter(function () {
                return $.trim($(this).val()).length == 0
              }).length == 0;
            var resultSelect = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active select[required]').filter(function () {
                return $.trim($(this).val()).length == 0
            }).length == 0;
            if(resultInput == true && resultSelect == true){
                var activeHeader =  $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-menu.template'+nextTab+' a.list-group-item.active');
                var activeContent = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active');
                activeHeader.children('h4').removeClass('glyphicon-tags');
                activeHeader.children('h4').addClass('glyphicon-check');
                if(parseInt(activeHeader.children('b').text()) != (inputNumerOfItemsValue)){
                    
                    activeHeader.removeClass('active');
                    activeHeader.next().addClass('active');
                    activeContent.removeClass('active');
                    activeContent.next().addClass('active');
                    
                    //window.setInterval(function() {
                        
                        
                        var elem = $('div.bhoechie-tab-container.template'+nextTab+' .bhoechie-tab-content.active');
                        
                        $('body').scrollTop(elem.offset().top);
                    //}, 5000);
                }
            }else{
                swal("Cancelled", "Fill Up Fields.", "error");
                return false;
            }
        });
        */
        //CACHE QUESTION TYPE
        var i = $('ul.tab-header > li.active').index()-1;
        var idQuestionnaire = $('#questionaire-idquestionaire').val();
        var inputTitle = $('#questionnaire-add-title').val();
        var inputDescription = $('#questionnaire-add-description').val();
        var inputDate = $('#questionnaire-add-day').val();
        var inputTime = $('#questionnaire-add-time').val();
        var inputDuration = $('#questionnaire-add-duration').val();
        var inputInstruction = $('#questionnaire-add-instruction').val();
        var inputIdSubject= $('#questionaire-idsubject').val();
        
        var inputData = [];
        inputData = {
                
            'data' : {
                'idquestionaire': idQuestionnaire,
                "questionaire_title": inputTitle,
                "questionaire_description": inputDescription,
                "questionaire_date": inputDate,
                "questionaire_time": inputTime,
                "questionaire_duration": inputDuration,
                "questionaire_instruction": inputInstruction,
                "idsubject":inputIdSubject
            }
            
        };
        
      
            var itemsCount = $('div.bhoechie-tab-menu.template'+i+' a').length;
            var questionType = $('#tab-add-question'+i).data('questiontype');
            var categoryTitle = $('#category-title-tabNo'+i+'').val();
            var questionQuantity = $('#question-quantity-tabNo'+i+'').val();
            var itemPoints = $('#item-points-tabNo'+i+'').val();
            var itemQuantity = $('#item-quantity-tabNo'+i+'').val();
            var totalItem = $('#total-item-tabNo'+i+'').val();
            
            inputData[0] = [];                          
            
            inputData[0] = {
                'data' : {
                    'questionaire_type_title': categoryTitle,
                    'questionaire_type': questionType,
                    'questionaire_type_question_quantity':questionQuantity,
                    'questionaire_type_item_points':itemPoints,
                    'questionaire_type_item_quantity':itemQuantity,
                    'questionaire_type_total_item':totalItem,
                }
            };
            for(j=0;j<itemsCount;j++){
                inputData[0][j] = [];
                inputData[0][j] = {
                    "question": ""
                }
                if(questionType == 0){
                    var choicesCount = $('center#add-answer0-0 > div.input-group').length;
                    
                    for(k=0;k<choicesCount;k++){
                        inputData[0][j][k] = [];
                        inputData[0][j][k] = "";
                    }
                    var selectValue = $('#answerTabno-'+i+'-itemno-'+j+'-answerno-0').val();
                    inputData[0][j].answer = "";

                }else{
                    var answerCount = $('center#add-answer'+i+'-'+j+' div.add-answer > span.span-add-answer'+i+' > div.input-group').length;
                    for(k=0;k<answerCount;k++){
                        inputData[0][j][k] = [];
                        inputData[0][j][k] = "";
                    }
                    
                }

            }
        
    
        $.ajax({
            url:"examinations/addQuestionnaireType",
            data:{data:inputData},
            method:"POST",
            dataType:"json",
            success:function(data){
                if(data[1] != []){
                    console.log(data[1]);
                    $('#questionaire-idquestionaire').val(data[1].idquestionaire);
                    $('#idcategory-tabNo'+nextTab+'').val(data[1].idquestionaire_type);
                    for(i=0;i<data[1].idquestion.length;i++){
                        
                        $('#idquestionTabno-tabNo'+nextTab+'-itemno-'+i+'').val(data[1].idquestion[i]);

                        if(inputTypeValue == 0){

                            for(j=0;j<data[1].choices[i].idquestion_choices.length;j++){
                                $('#idchoicestabNo'+nextTab+'-itemno-'+i+'choicesno-'+j+'').val(data[1].choices[i].idquestion_choices[j]);
                            }
                            $('#idanswertabNo'+nextTab+'-itemno-'+i+'answerno-0').val(data[1].answer[i].idquestion_answer[0]);
                            
                        }else if(inputTypeValue == 1){
                            if(Array.isArray(data[1].answer)){
                                if(data[1].answer.length > 0){
                                    for(j=0;j<data[1].answer[i].idquestion_answer.length;j++){
                                        $('#idanswertabNo'+nextTab+'-itemno-'+i+'answerno-'+j+'').val(data[1].answer[i].idquestion_answer[j]);
                                    }
                                }
                            }
                            
                            
                        }
                    }
                }
            }
        });
        
        
        //CACHE QUESTION TYPE END

        $(document).on("click","div.bhoechie-tab-menu.template"+nextTab+">div.list-group>a",function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            
            $("div.bhoechie-tab-container.template"+nextTab+">div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab-container.template"+nextTab+">div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });

        tinymce.init({
                selector: '.mytextarea'
        });
    });
    //********  ADD QUESTIONAIRE TYPE END */

    //EMPTY ADD QUESTIONNAIRE SETTINGS INPUT
    $(document).on('click','#tab-header-add-question',function(e){
        $('#select-question-type-input').val("0");
        $('#questionaire-case-input').val("");
        $('#category-title-input').val("");
        $('#number-of-points-input').val("");
        $('#number-of-items-input').val("");
        $('#total-points-input').val("");
    });
    //EMPTY ADD QUESTIONNAIRE SETTINGS INPUT END

    $(document).on('focusout', '#number-of-items-input', function(e){
        e.preventDefault();
        var inputNumberOfPoints = $('#number-of-points-input').val();
        var inputNumberOfPointsValue = $('#number-of-items-input').val();
        $('#total-points-input').val((inputNumberOfPoints*inputNumberOfPointsValue));
        
    });
    $(document).on('focusout', '#number-of-points-input', function(e){
        e.preventDefault();
        var inputNumberOfPoints = $('#number-of-points-input').val();
        var inputNumberOfPointsValue = $('#number-of-items-input').val();
        $('#total-points-input').val((inputNumberOfPoints*inputNumberOfPointsValue));
        
    });
   
    $(document).on('change', '#select-question-type-input', function(e){
        e.preventDefault();
        var selectDropdown = $(this);
        
        if(selectDropdown.val() == 0){
            var inputCase = '<div class="input-group">'
                                +'<span class="input-group-addon" id="span-answer-case-method">Question Quantity</span>'
                                +'<input type="text" class="form-control use" placeholder="Enter Number of Answer Question" aria-describedby="basic-addon1" required="required" id="questionaire-case-input" name="questionaire_answer_quantity" pattern="[0-9]+">'
                            +'</div>';
        $(inputCase).insertAfter(selectDropdown.parent().next('div'));
        }else if(selectDropdown.val() == 1){
            var spanAnswerCase = $('span#span-answer-case-method');
            spanAnswerCase.parent().remove();
        }
        
    });
    
    //tinyMCE TO SUBMIT
    $(document).on('mousedown','#frm-add-questionnaire', function() {
        tinyMCE.triggerSave();
    });
    //

    //SUBMIT ADD QUESTIONNAIRE
    $(document).on('submit','#frm-add-questionnaire',function(e){
        e.preventDefault();
        tinyMCE.triggerSave();
        if($('#tab-header li').length-1 <= 0){
            swal("Cancelled", "Add Question Item First.", "error");
            return false;
        }
        var resultInput = $('div.bhoechie-tab-container div.bhoechie-tab-content.active input[required]:checked').filter(function () {
            return $.trim($(this).val()).length == 0
          }).length == 0;
        var resultSelect = $('div.bhoechie-tab-container div.bhoechie-tab-content.active textarea[required]').filter(function () {
            return $.trim($(this).val()).length == 0
        }).length == 0;
        if(resultInput == true || resultSelect == true){
            var date = new Date(Date.now());
            var month = date.getMonth();
            var day = date.getDate().toString();
            var year = date.getFullYear();
            
       
            year = year.toString().substr(-2);
            month = (month + 1).toString();
    
       
            if (month.length === 1)
            {
                month = "0" + month;
            }
        
            if (day.length === 1)
            {
                day = "0" + day;
            }
            var examDate = new Date($('#questionnaire-add-day').val()).getTime();
            var todayDate = new Date(month +'-'+day + '-' + year).getTime();
           
            if(examDate < todayDate){
                swal("Date Should be greater that current date", "invalid Date Input", "error");
                return false;
            }
         
            swal({
                title: "Are you sure?",
                text: "Do you want to add this record?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Add it!",
                cancelButtonText: "No, ",
                closeOnConfirm: false,
                closeOnCancel: false
                },
                function(isConfirm){
                if (isConfirm) {
                    
             
                    $.ajax({
                        url:"examinations/submitQuestionnaire",
                        data:{idquestionaire:$('#questionaire-idquestionaire').val()},
                        method:"POST",
                        dataType:"json",
                        success:function(data){
                            if(data[1] == true){
                                swal("success", "Record Added.", "success");   
                                window.location.replace('examinations/userquestionairelist/'+$('#questionaire-idsubject').val()+'')
                                $('#mdl-classes-update').modal('hide');
                            }else{
                                swal("cancelled", data[0], "error");
                            }
                        }
                    });
    
                } else {
                    swal("Cancelled", "Add Canceled.", "error");
                }
            });
        }else{
            swal("Cancelled", "Fill up All Fields.", "error");
        }
        
    });
    //SUBMIT ADD QUESTIONNAIRE END 

    //SUBMIT DELETE QUESTIONNAIRE 
    
    $(document).on('click','.btn-delete-questionaire',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:'examinations/deleteQuestionaire',
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0] , "error");
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //SUBMIT DELETE QUESTIONNAIRE END 

    
    $(document).on('click','.button-fullscreen',function(e){
        swal({
            title: "Are you Sure?",
            text: "Press ok to proceed",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                
                $('#agreement-container').hide();
                $('div#modal-static-examine').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('div#modal-static-examine').modal('show');
                
                //fullScreenToggle(document.getElementById('modal-static-examine'));
    
                var idquestionaire = $('#input-idquestionaire').val();
                $.ajax({
                    url:'examinations/examinestart',
                    data:{idquestionaire:idquestionaire},
                    dataType:"json",
                    method:"POST",
                    success:function(data){
                       
                    }
                    
                });
                
                // PAGE FOCUS LISTENER
                var count = 0;
                var myInterval;
                // Active
                window.addEventListener('focus', startTimer);
                
                // Inactive
                window.addEventListener('blur', stopTimer);
                
                //COUNT TIME
                function timerHandler() {
                    count++;
                }
            
                // Start timer
                function startTimer() {
                    
                    myInterval = window.setInterval(function(){
                        timerHandler
                    }, 1000);
                }
                
                function stopTimer() {
                    clearInterval(myInterval);
                    var contentTabHeader = $('ul > li.tab-examine');
                    var dataAnswers = [];
    
                    dataAnswers = {
                        'userduration' : parseInt($("#countdownduration").val())-(parseInt(clock.getTime())),
                        'idquestionaire' : $('#input-idquestionaire').val()
                    }
                    for(i=0;i<contentTabHeader.length;i++){
                        dataAnswers[i] = [];
                        dataAnswers[i] = {};
                        var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                        for(j=0;j<itemsCount;j++){
                            dataAnswers[i][j] = [];
                            dataAnswers[i][j] = {
                                'idquestion':$('#input-idquestion-tabno'+i+'-'+j+'').val()
                            };
                            if($('.answer'+i+'-'+j+'').data('type') == 0){
                                dataAnswers[i][j][0] = $('.answer'+i+'-'+j+':checked').val();
                                
                            }else{
                                dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val(); dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val();
                                
                            }
                            
                        }
                    }
                    
                    function messageWithReload(){
                        
                        
                        swal("Submitted !", "Due to Page Inactive Examination Will be invalid, ask your teacher to take it again", "success");
                        window.location.replace('examinations');
                    }
    
                    $.ajax({
                        url:'examinations/submitexamine',
                        data:{data:dataAnswers},
                        dataType:"json",
                        method:"POST",
                        success:function(data){
                            if(data[1] == true){
                                messageWithReload();
                            }else{
                                messageWithReload();
                            }
                        },
                        complete:function(){
                            messageWithReload();
                        }
                        
                    });
                    
                }
                
    
                // Stop timer
                
                //
                // PAGE FOCUS LISTENER END
    
    
                //COUNTDOWN TIMER
                
                
                clock = $('.clock').FlipClock({
                    
                        
                    clockFace: 'DailyCounter',
                    autoStart: false,
                    callbacks: {
                       
                        stop: function() {
                            swal("Expired", "Time's Up !", "error");
                            var contentTabHeader = $('ul > li.tab-examine');
                            var dataAnswers = [];
                            dataAnswers = {
                                'userduration' : parseInt($("#countdownduration").val())-(parseInt(clock.getTime())),
                                'idquestionaire' : $('#input-idquestionaire').val()
                            }
                            for(i=0;i<contentTabHeader.length;i++){
                                dataAnswers[i] = [];
                                dataAnswers[i] = {};
                                var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                                for(j=0;j<itemsCount;j++){
                                    dataAnswers[i][j] = [];
                                    dataAnswers[i][j] = {
                                        'idquestion':$('#input-idquestion-tabno'+i+'-'+j+'').val()
                                    };
                                    if($('.answer'+i+'-'+j+'').data('type') == 0){
                                        dataAnswers[i][j][0] = $('.answer'+i+'-'+j+':checked').val();
                                        
                                    }else{
                                        dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val();
                                        
                                    }
                                    
                                }
                            }
                            
                            
                            $.ajax({
                                url:'examinations/submitexamine',
                                data:{data:dataAnswers},
                                dataType:"json",
                                method:"POST",
                                success:function(data){
                                    if(data[1] == true){
                                        swal("success", "Your Examination Has Been Submitted.", "success");
                                        window.location.replace('examinations');
                                    }else{
                                        swal("Cancelled", "Error Delete Record.", "error");
                                    }
                                }
                                
                            });
                        }
                    }
                });
                    
                clock.setTime(parseInt($("#countdownduration").val()));
                clock.setCountdown(true);
                clock.start();
                
                /*
                var countDownDate = (new Date(Date.now()).getTime() + (+2)*100);
                
                
                // Update the count down every 1 second
                var x = setInterval(function() {
            
                    // Get todays date and time
                    var now = new Date(Date.now()).getTime();
                    
                    // Find the distance between now an the count down date
                    var distance = countDownDate - now;
                    
                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    // Output the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";
                    
                    // If the count down is over, write some text 
                    if (distance < 0) {
                        
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                        
                    }
                }, 1000);
                //COUNTDOWN TIMER END
                */
                
            } else {
                swal("Cancelled", "Cancelled", "error");
            }
    
        });
        
        $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
            if(!IsFullScreenCurrently()){
                fullScreenToggle(document.getElementById('modal-static-examine'));
            }
            
        });
    });

    function goToFullScreen(){
        
    
        
    
    }    
   
    

});// DOCUMENT READY END


//EXAMINE FULL SCREEN 


//
var clock; //GLOBAL CLOCK VARIABLE FOR EXAM

function goToFullScreen(){
    

    swal({
        title: "Are you Sure?",
        text: "Press yes to proceed",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
        },
        function(isConfirm){
        
        if (isConfirm) {
            
            
            $('#agreement-container').hide();
            $('div#modal-static-examine').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('div#modal-static-examine').modal('show');
            
            
            //fullScreenToggle(document.getElementById('modal-static-examine'));

            var idquestionaire = $('#input-idquestionaire').val();
            $.ajax({
                url:'examinations/examinestart',
                data:{idquestionaire:idquestionaire},
                dataType:"json",
                method:"POST",
                success:function(data){
                   
                }
                
            });
            
            // PAGE FOCUS LISTENER
            var count = 0;
            var myInterval;
            // Active
            window.addEventListener('focus', startTimer);
            
            // Inactive
            window.addEventListener('blur', stopTimer);
            
            //COUNT TIME
            function timerHandler() {
                count++;
            }
        
            // Start timer
            function startTimer() {
                
                myInterval = window.setInterval(function(){
                    timerHandler
                }, 1000);
            }
            
            function stopTimer() {
                clearInterval(myInterval);
                var contentTabHeader = $('ul > li.tab-examine');
                var dataAnswers = [];

                dataAnswers = {
                    'userduration' : parseInt($("#countdownduration").val())-(parseInt(clock.getTime())),
                    'idquestionaire' : $('#input-idquestionaire').val()
                }
                for(i=0;i<contentTabHeader.length;i++){
                    dataAnswers[i] = [];
                    dataAnswers[i] = {};
                    var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                    for(j=0;j<itemsCount;j++){
                        dataAnswers[i][j] = [];
                        dataAnswers[i][j] = {
                            'idquestion':$('#input-idquestion-tabno'+i+'-'+j+'').val()
                        };
                        if($('.answer'+i+'-'+j+'').data('type') == 0){
                            dataAnswers[i][j][0] = $('.answer'+i+'-'+j+':checked').val();
                            
                        }else{
                            dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val();
                            
                        }
                        
                    }
                }
                
                function messageWithReload(){
                    
                    
                    swal("Submitted !", "Due to Page Inactive Examination Will be invalid, ask your teacher to take it again", "success");
                    window.location.replace('examinations');
                }

                $.ajax({
                    url:'examinations/submitexamine',
                    data:{data:dataAnswers},
                    dataType:"json",
                    method:"POST",
                    success:function(data){
                        if(data[1] == true){
                            messageWithReload();
                        }else{
                            messageWithReload();
                        }
                    },
                    complete:function(){
                        messageWithReload();
                    }
                    
                });
                
            }
            

            // Stop timer
            
            //
            // PAGE FOCUS LISTENER END


            //COUNTDOWN TIMER
            
            
            clock = $('.clock').FlipClock({
                
                    
                clockFace: 'DailyCounter',
                autoStart: false,
                callbacks: {
                   
                    stop: function() {
                        swal("Expired", "Time's Up !", "error");
                        var contentTabHeader = $('ul > li.tab-examine');
                        var dataAnswers = [];
                        dataAnswers = {
                            'userduration' : parseInt($("#countdownduration").val())-(parseInt(clock.getTime())),
                            'idquestionaire' : $('#input-idquestionaire').val()
                        }
                        for(i=0;i<contentTabHeader.length;i++){
                            dataAnswers[i] = [];
                            dataAnswers[i] = {};
                            var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                            for(j=0;j<itemsCount;j++){
                                dataAnswers[i][j] = [];
                                dataAnswers[i][j] = {
                                    'idquestion':$('#input-idquestion-tabno'+i+'-'+j+'').val()
                                };
                                if($('.answer'+i+'-'+j+'').data('type') == 0){
                                    dataAnswers[i][j][0] = $('.answer'+i+'-'+j+':checked').val();
                                    
                                }else{
                                    dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val();
                                    
                                }
                                
                            }
                        }
                        
                        
                        $.ajax({
                            url:'examinations/submitexamine',
                            data:{data:dataAnswers},
                            dataType:"json",
                            method:"POST",
                            success:function(data){
                                if(data[1] == true){
                                    swal("success", "Your Examination Has Been Submitted.", "success");
                                    window.location.replace('examinations');
                                }else{
                                    swal("Cancelled", "Error Delete Record.", "error");
                                }
                            }
                            
                        });
                    }
                }
            });
                
            clock.setTime(parseInt($("#countdownduration").val()));
            clock.setCountdown(true);
            clock.start();
            
            /*
            var countDownDate = (new Date(Date.now()).getTime() + (+2)*100);
            
            
            // Update the count down every 1 second
            var x = setInterval(function() {
        
                // Get todays date and time
                var now = new Date(Date.now()).getTime();
                
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                // Output the result in an element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
                
                // If the count down is over, write some text 
                if (distance < 0) {
                    
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                    
                }
            }, 1000);
            //COUNTDOWN TIMER END
            */
            
        } else {
            swal("Cancelled", "Cancelled", "error");
        }

    });
    
    $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
        if(!IsFullScreenCurrently()){
            fullScreenToggle(document.getElementById('modal-static-examine'));
        }
        
    });

}
function IsFullScreenCurrently() {
	var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;
	// If no element is in full-screen
	if(full_screen_element === null)
		return false;
	else
		return true;
}

$(document).on('click','.btn-submit-examine',function(e){
    e.preventDefault();

    swal({
        title: "Are you sure?",
        text: "Do you want to Submit Your Examination ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, submit it!",
        cancelButtonText: "No, ",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        
            if (isConfirm) {
                
                var contentTabHeader = $('ul > li.tab-examine');
                var dataAnswers = [];

                dataAnswers = {
                    'userduration' : parseInt($("#countdownduration").val())-(parseInt(clock.getTime())),
                    'idquestionaire' : $('#input-idquestionaire').val()
                }
                for(i=0;i<contentTabHeader.length;i++){
                    dataAnswers[i] = [];
                    dataAnswers[i] = {};
                    var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                    for(j=0;j<itemsCount;j++){
                        dataAnswers[i][j] = [];
                        dataAnswers[i][j] = {
                            'idquestion':$('#input-idquestion-tabno'+i+'-'+j+'').val()
                        };
                        if($('.answer'+i+'-'+j+'').data('type') == 0){
                            dataAnswers[i][j][0] = $('.answer'+i+'-'+j+':checked').val();
                            
                        }else{
                            dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val();
                            
                        }
                        
                    }
                }
                
                
                $.ajax({
                    url:'examinations/submitexamine',
                    data:{data:dataAnswers},
                    dataType:"json",
                    method:"POST",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Your Examination Has Been Submitted.", "success");
                            window.location.replace('examinations');
                        }else{
                            swal("Cancelled", "Error Delete Record.", "error");
                        }
                    }
                    
                });
                
            
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        }
    );
    
});


function fullScreenToggle(elem) {
    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
}
//EXAMINE FULL SCREEN END

//

$(document).on("click","div.bhoechie-tab-menu>div.list-group>a",function(e) {
    e.preventDefault();
    $(this).siblings('a.active').removeClass("active");
    $(this).addClass("active");
    var index = $(this).index();
    var tabNo = $(this).data('tab');
    
    $("div.bhoechie-tab-container>div.bhoechie-tab>div.bhoechie-tab-content.btcontent-template-tab"+tabNo+"").removeClass("active");
    $("div.bhoechie-tab-container>div.bhoechie-tab>div.bhoechie-tab-content.btcontent-template-tab"+tabNo+"").eq(index).addClass("active");
});


$(document).on("click",".btn-next-item",function(e) {
    e.preventDefault();
    
    var button = $(this);
    var nextTab = button.data('tabno');
    var spanNext = button.parent();
    var inputNumerOfItemsValue = $('div.btmenu-template'+nextTab+'>div.list-group > a').length;
    
    var resultInput = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active input[required]:checked').filter(function () {
        return $.trim($(this).val()).length == 0
      }).length == 0;
    var resultSelect = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active textarea[required]').filter(function () {
        return $.trim($(this).val()).length == 0
    }).length == 0;
    if(resultInput == true && resultSelect == true){
        /**/ 
        
        if($('#questionnaire-add-title').val() == "" || $('#questionnaire-add-description').val() == "" || $('#questionnaire-add-day').val() == "" || $('#questionnaire-add-time').val() == "" || $('#questionnaire-add-duration').val() == "" || $('#questionnaire-add-instruction').val() == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }
    
        var idquestionaire = $('#questionaire-idquestionaire').val();
        var questionaire_title = $('#questionnaire-add-title').val();
        var questionaire_description = $('#questionnaire-add-description').val();
        var questionaire_date = $('#questionnaire-add-day').val();
        var questionaire_time = $('#questionnaire-add-time').val();
        var questionaire_duration = $('#questionnaire-add-duration').val();
        var questionaire_instruction = $('#questionnaire-add-instruction').val();
       
            
        /**/
        var tabIndex = $('ul.tab-header > li.active').index()-1;
        var itemIndex = $('div.bhoechie-tab-menu.template'+tabIndex+'>div.list-group > a.active').index();
        var itemData = [];
        var questionType = $('#tab-add-question'+tabIndex).data('questiontype');
        var idquestion = $('#idquestionTabno-tabNo'+tabIndex+'-itemno-'+itemIndex+'').val();
        var question = $("#questionTabno"+tabIndex+"-itemno-"+itemIndex+"").val();
        if(questionType == 0){
            var questionQuantity = $('#question-quantity-tabNo'+tabIndex+'').val();
            var choices = [];
            var selectval = $('#answerTabno-'+tabIndex+'-itemno-'+itemIndex+'-answerno-0').val();
            for(j=0;j<parseInt(questionQuantity);j++){
                
                choices[j] = {
                    'idchoices': $('#idchoicestabNo'+tabIndex+'-itemno-'+itemIndex+'choicesno-'+j+'').val(),
                    'choices': $('#choicesTabno-'+tabIndex+'-itemno-'+itemIndex+'-choicesno-'+j+'').val()
                }
            }
            var answer = [];
            answer[0] = {
                'idanswer':$('#idanswertabNo'+tabIndex+'-itemno-'+itemIndex+'answerno-0').val(),
                'answer': $('#choicesTabno-'+tabIndex+'-itemno-'+itemIndex+'-choicesno-'+selectval+'').val()
            }
        }else{
            var questionQuantity = 0;
            var choices = [];
            var answerCount = $('center#add-answer'+tabIndex+'-'+itemIndex+' div.add-answer > span.span-add-answer'+tabIndex+' > div.input-group').length
            var answer = [];
            for(j=0;j<answerCount;j++){
                answer[j] = {
                    'idanswer':$('#idanswertabNo'+tabIndex+'-itemno-'+itemIndex+'answerno-'+j+'').val(),
                    'answer':$('#answerTabno-'+tabIndex+'-itemno-'+itemIndex+'-answerno-'+j+'').val()
                }
            }
        }

        itemData = {
            'questionaire':{
                'idquestionaire':idquestionaire,
                'questionaire_title':questionaire_title,
                'questionaire_description':questionaire_description,
                'questionaire_date':questionaire_date,
                'questionaire_time':questionaire_time,
                'questionaire_duration':questionaire_duration,
                'questionaire_instruction':questionaire_instruction
            },
            'question_type':questionType,
            'idquestion':idquestion,
            'question':question,
            'choices':choices,
            'answer':answer
        }

        
        $.ajax({
            url:'examinations/updatequestion',
            data:{data:itemData},
            dataType:"json",
            method:"POST",
            success:function(data){
                if(data[1] == true){
                    if(Array.isArray(data[0])){
                        for(j=0;j<data[0].length;j++){
                            $('#idanswertabNo'+tabIndex+'-itemno-'+itemIndex+'answerno-'+j+'').val(data[0][j]);
                        }
                    }
                }

                var tabIndex = $('ul.tab-header > li.active').index()-1;
                var activeHeader = $('div.bhoechie-tab-menu.template'+tabIndex+' div.list-group a.active');
                var activeContent = $('div.bhoechie-tab-container.template'+tabIndex+' div.bhoechie-tab-content.active');

                //var activeHeader =  $('div.btmenu-template'+nextTab+'>div.list-group > a.active');
                activeHeader.children('h4').removeClass('glyphicon-tags');
                activeHeader.children('h4').addClass('glyphicon-check');
                
        
                if(parseInt(activeHeader.children('b').text()) < ($('div.bhoechie-tab-menu.template'+tabIndex+' div.list-group a').length)){
                    
                
                    activeHeader.removeClass('active');
                    activeHeader.next().addClass('active');
                    activeContent.removeClass('active');
                    activeContent.next().addClass('active');
                    
                    //window.setInterval(function() {
                    
                    
                    var elem = $('div.bhoechie-tab-container.template'+tabIndex+' .bhoechie-tab-content.active');
                
                    //}, 5000);
                }else{
                   
                    var contentTabHeader = $('ul.tab-header > li');
                    var contentTabHeaderActive = $('ul.tab-header > li.active');
                    var contentTabContentActive = $('#tab-add-question'+tabIndex+'.active');
                    if(contentTabHeader.length != tabIndex){
                     
                        if((contentTabHeader.length-1) > (contentTabHeaderActive.index())){
                            contentTabHeaderActive.removeClass('in active');
                            contentTabContentActive.removeClass('in active');
                            contentTabHeaderActive.next().addClass('in active');
                            contentTabContentActive.next().addClass('in active');
                        }
        
                        /*
                        else{
                            fullScreenToggle(document.getElementById('modal-static-examine'));
                            swal({
                                title: "Are you sure?",
                                text: "Do you want to submit your exam?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes, submit it!",
                                cancelButtonText: "No, ",
                                closeOnConfirm: false,
                                closeOnCancel: false
                                },
                                function(isConfirm){
                                
                                if (isConfirm) {
                                    var dataAnswers = [];
                                    dataAnswers = {
                                        'userduration' : parseInt($("#countdownduration").val())-(parseInt(clock.getTime())),
                                        'idquestionaire' : $('#input-idquestionaire').val()
                                    }
                                    for(i=0;i<contentTabHeader.length;i++){
                                        dataAnswers[i] = [];
        
                                        var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                                        for(j=0;j<itemsCount;j++){
                                            dataAnswers[i][j] = [];
                                            dataAnswers[i][j] = {
                                                'idquestion':$('#input-idquestion-tabno'+i+'-'+j+'').val()
                                            };
                                            if($('.answer'+i+'-'+j+'').data('type') == 0){
                                                dataAnswers[i][j][0] = $('.answer'+i+'-'+j+':checked').val();
                                                
                                            }else{
                                                dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val();
                                                
                                            }
                                            
                                            
                                        }
                                    }
                                    
                                    
                                    $.ajax({
                                        url:'examinations/submitexamine',
                                        data:{data:dataAnswers},
                                        dataType:"json",
                                        method:"POST",
                                        success:function(data){
                                            if(data[1] == true){
                                                swal("success", "Your Examination Has Been Submitted.", "success");
                                                window.location.replace('examinations');
                                            }else{
                                                swal("Cancelled", "Error Delete Record.", "error");
                                            }
                                        }
                                        
                                    });
                                } else {
                                    swal("Cancelled", "Delete Canceled.", "error");
                                }
                            });
                        }*/
                        
                     
                    }
                }
            }
            
        });

        
    }else{
        swal("Cancelled", "Fill Up Fields.", "error");
        return false;
    }

});

// UPDATE QUESTIONNAIRE


$(document).on('submit','#frm-update-questionnaire',function(e){
    e.preventDefault();
    tinyMCE.triggerSave();
    if($('#tab-header li').length-1 <= 0){
        swal("Cancelled", "Add Question Item First.", "error");
        return false;
    }
    var examDate = new Date($('#questionnaire-add-day').val());
    var todayDate = new Date(Date.now());
    if(examDate < todayDate){
        swal("Date Should be greater that current date", "invalid Date Input", "error");
        return false;
    }
 
    swal({
        title: "Are you sure?",
        text: "Do you want to Update this record?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, update it",
        cancelButtonText: "No, ",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        if (isConfirm) {

            var tabPanelCount = $('#tab-header li').length-1;
            var inputTitle = $('#questionnaire-title').val();
            var inputDescription = $('#questionnaire-description').val();
            var inputDate = $('#questionnaire-day').val();
            var inputTime = $('#questionnaire-time').val();
            var inputDuration = $('#questionnaire-duration').val();
            var inputInstruction = $('#questionnaire-instruction').val();
            var inputIdSubject= $('#questionaire-idsubject').val();
            var inputIdQuestionnaire= $('#questionaire-idquestionnaire').val();
            var questionaireTypeInitialCount = $('#questionairetype-initialcount').val();
            var inputData = [];
            inputData = {
                    
                'data' : {

                    "questionaire_title": inputTitle,
                    "questionaire_description": inputDescription,
                    "questionaire_date": inputDate,
                    "questionaire_time": inputTime,
                    "questionaire_duration": inputDuration,
                    "questionaire_instruction": inputInstruction,
                    "idsubject":inputIdSubject,
                    "idquestionaire":inputIdQuestionnaire,
                    "initialCount":questionaireTypeInitialCount
                }
                
            };
          
            
            
            for(i=0;i<tabPanelCount;i++){
                var questionnaireTypeId = $('#questionnaire-type-idquestionairetype'+i+'').val();
                var itemsCount = $('div.bhoechie-tab-menu.template'+i+' a').length;
                var questionType = $('#tab-add-question'+i).data('questiontype');
                var categoryTitle = $('#category-title-tabNo'+i+'').val();
                var questionQuantity = $('#question-quantity-tabNo'+i+'').val();
                var itemPoints = $('#item-points-tabNo'+i+'').val();
                var itemQuantity = $('#item-quantity-tabNo'+i+'').val();
                var totalItem = $('#total-item-tabNo'+i+'').val();
                
                inputData[i] = [];                          
                
                inputData[i] = {
                    'data' : {
                        'idquestionairetype':questionnaireTypeId,
                        'questionaire_type_title': categoryTitle,
                        'questionaire_type': questionType,
                        'questionaire_type_question_quantity':questionQuantity,
                        'questionaire_type_item_points':itemPoints,
                        'questionaire_type_item_quantity':itemQuantity,
                        'questionaire_type_total_item':totalItem,
                    }
                };
                for(j=0;j<itemsCount;j++){
                    inputData[i][j] = [];
                    var question = tinymce.get("questionTabno"+i+"-itemno-"+j+"").getContent();
                    var idquestion = $('#question-idquestion'+i+'-'+j+'').val();
                    
                    inputData[i][j] = {
                        "data":{
                            "idquestion":idquestion,
                            "question": question
                        }
                    }
                    if(questionType == 0){
                        var choicesCount = $('center#add-answer0-0 > div.input-group').length;
                        
                        for(k=0;k<choicesCount;k++){
                            inputData[i][j][k] = [];
                            inputData[i][j][k] = {
                                'choices_description':$('#choicesTabno-'+i+'-itemno-'+j+'-choicesno-'+k+'').val(),
                                'idchoices':$('#input-question-idchoices'+i+'-'+j+'-'+k+'').val()
                            }
                        }
                        var selectValue = $('#answerTabno-'+i+'-itemno-'+j+'-answerno-0').val();
                        var answer = $('#choicesTabno-'+i+'-itemno-'+j+'-choicesno-'+selectValue+'').val();
                        var idanswer = $('#input-question-idanswer'+i+'-'+j+'-0').val();
                        inputData[i][j].data.answer = answer;
                        inputData[i][j].data.idanswer = idanswer;

                    }else{
                        var answerCount = $('center#add-answer'+i+'-'+j+' div.add-answer > span.span-add-answer'+i+' > div.input-group').length
                        var initialAnswerCount = $('input#tab-'+i+'-item-'+j+'-essay-answer-initial-count').val();
                        inputData[i][j].data.initialAnswerCount = initialAnswerCount;
                        for(k=0;k<answerCount;k++){
                            inputData[i][j][k] = [];
                            
                            inputData[i][j][k] = {
                                
                                "data":{
                                    'answer':$('#answerTabno-'+i+'-itemno-'+j+'-answerno-'+k+'').val(),
                                    'idanswer':$('#input-question-idanswer'+i+'-'+j+'-'+k+'').val()
                                }
                            }
                            
                            
                        }
                        
                    }


                }
            }
            
            $.ajax({
                url:"examinations/postUpdateQuestionnaire",
                data:{data:inputData},
                method:"POST",
                dataType:"json",
                success:function(data){
                    if(data[1] == true){
                        swal("success", "Record Updated.", "success");   
                        window.location.replace('examinations/userquestionairelist/'+data[2]+'')
                        $('#mdl-classes-update').modal('hide');
                    }else{
                        swal("cancelled", data[0], "error");
                    }
                }
            });

        } else {
            swal("Cancelled", "Update Canceled.", "error");
        }
    });
});
// UPDATE QUESTIONNAIRE END




//next ITEM
$(document).on('click','.btn-next-examination-item',function(e){
    e.preventDefault();
    
    var button = $(this);
    var nextTab = button.data('tabno');
    var spanNext = button.parent();
    var inputNumerOfItemsValue = $('div.btmenu-template'+nextTab+'>div.list-group > a').length;
    
    var resultInput = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active input[required]:checked').filter(function () {
        return $.trim($(this).val()).length == 0
      }).length == 0;
    var resultSelect = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active textarea[required]').filter(function () {
        return $.trim($(this).val()).length == 0
    }).length == 0;
    if(resultInput == true && resultSelect == true){
        var activeHeader =  $('div.btmenu-template'+nextTab+'>div.list-group > a.active');
        var activeContent = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active');
        activeHeader.children('h4').removeClass('glyphicon-tags');
        activeHeader.children('h4').addClass('glyphicon-check');
        
        if(parseInt(activeHeader.children('b').text()) < (inputNumerOfItemsValue)){
            
        
            activeHeader.removeClass('active');
            activeHeader.next().addClass('active');
            activeContent.removeClass('active');
            activeContent.next().addClass('active');
            
            //window.setInterval(function() {
            
            
            var elem = $('div.bhoechie-tab-container.template'+nextTab+' .bhoechie-tab-content.active');
        
            //}, 5000);
        }else{
           
            var contentTabHeader = $('ul > li.tab-examine');
            var contentTabHeaderActive = $('ul li.tab-examine.tabno'+nextTab+'.active');
            var contentTabContentActive = $('#tab-examine'+nextTab+'.active');
            if(contentTabHeader.length != nextTab){
             
                if((contentTabHeader.length-1) > (contentTabHeaderActive.index())){
                    contentTabHeaderActive.removeClass('in active');
                    contentTabContentActive.removeClass('in active');
                    contentTabHeaderActive.next().addClass('in active');
                    contentTabContentActive.next().addClass('in active');
                }else{
                    //fullScreenToggle(document.getElementById('modal-static-examine'));
                    /*swal({
                        title: "Are you sure?",
                        text: "Do you want to submit your exam?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, submit it!",
                        cancelButtonText: "No, ",
                        closeOnConfirm: false,
                        closeOnCancel: false
                        },
                        function(isConfirm){
                        
                        if (isConfirm) {
                            var dataAnswers = [];
                            dataAnswers = {
                                'userduration' : parseInt($("#countdownduration").val())-(parseInt(clock.getTime())),
                                'idquestionaire' : $('#input-idquestionaire').val()
                            }
                            for(i=0;i<contentTabHeader.length;i++){
                                dataAnswers[i] = [];

                                var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                                for(j=0;j<itemsCount;j++){
                                    dataAnswers[i][j] = [];
                                    dataAnswers[i][j] = {
                                        'idquestion':$('#input-idquestion-tabno'+i+'-'+j+'').val()
                                    };
                                    if($('.answer'+i+'-'+j+'').data('type') == 0){
                                        dataAnswers[i][j][0] = $('.answer'+i+'-'+j+':checked').val();
                                        
                                    }else{
                                        dataAnswers[i][j][0] = $('.answer'+i+'-'+j+'').val();
                                        
                                    }
                                    
                                    
                                }
                            }
                            
                            
                            $.ajax({
                                url:'examinations/submitexamine',
                                data:{data:dataAnswers},
                                dataType:"json",
                                method:"POST",
                                success:function(data){
                                    if(data[1] == true){
                                        swal("success", "Your Examination Has Been Submitted.", "success");
                                        window.location.replace('examinations');
                                    }else{
                                        swal("Cancelled", "Error Delete Record.", "error");
                                    }
                                }
                                
                            });
                        } else {
                            swal("Cancelled", "Delete Canceled.", "error");
                        }
                    });
                    */
                }
                
             
            }
        }
    }else{
        swal("Cancelled", "Fill Up Fields.", "error");
        return false;
    }
    
});

//btn-submit-disapproval
$(document).on('click','#btn-submit-disapproval',function(e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.data('id');
    var message = $('textarea#input-disapproval-message').val();
    if(message == ""){
        swal("Cancelled", "Fill Up Fields", "error");
        return false;
    }
    swal({
        title: "Are you sure?",
        text: "Disapprove this Questionnaire ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Disapprove it!",
        cancelButtonText: "No, ",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        
        if (isConfirm) {
            
            $.ajax({
            url:'notifications/disapprovequestionnaire',
            data:{id:id,message:message},
            dataType:"json",
            method:"POST",
            success:function(data){
                if(data[1] == true){
                    swal("Disapproved", "Questionnaire Disaproved", "success");
                    window.location.replace('notifications');
                    
                }else{
                    swal("Cancelled", "Fail to Submit Disapproval.", "error");
                }
            }
        });
        } else {
            swal("Cancelled", "Canceled.", "error");
        }
    });
    
    
});

$('#btn-questionnaire-disapproval').on('click',function(e){
    e.preventDefault();
    
    var btn = $(this);
    var idquestionnaire = btn.data('id');

    var htmlbody = '<div class="col-md-12">'
                    +'<div class="form-group">'
                        +'<label>Disapproval Message</label>'
                        +'<div class="form-group label-floating">'
                            +'<label class="control-label">Write Your Message Here . .</label>'
                            +'<textarea class="form-control" id="input-disapproval-message" required="required" rows="5" autofocus="autofocus"></textarea>'
                        +'</div>'
                    +'</div>'
                +'</div>';
   
    
    var htmlfooter = '<button type="submit" form="mdl-frm-post-message" class="btn btn-primary" id="btn-submit-disapproval" data-id="'+idquestionnaire+'"><i class="material-icons">check</i>SUBMIT DISAPPROVAL</button>'
                     +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i>CLOSE</button>';
    $('#mdl-title').html('Disapproval Message');
    $('.modal-body').html(htmlbody);
    $('.modal-footer').html(htmlfooter);
    $('.modal-dialog').attr('style','width:70%;');
    $('#modal-dynamic').modal('show');
  

});


$(document).on('click','.btn-report-update-essay-score',function(e){
    e.preventDefault();
    var btn = $(this);
    var itemPoints = btn.data('itempoints');
    var idquestionuseranswer = btn.data('idquestionuseranswer');
    var iduserquestionaire = btn.data('iduserquestionaire');
    var idquestion = btn.data('idquestion');
    var idusers = btn.data('idusers');
    var score = btn.data('questionscore');
    var questionnaireTotalScore = btn.data('questionnairetotalscore');
    swal({
        title: "Update Score",
        text: "Please Enter Question New Score",
        type: "input",
        input: "number",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "Enter Here. . . . ."
      }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
          swal.showInputError("You need to write something!");
          return false
        }
        if (isNaN(inputValue)) {
          swal.showInputError("Input should be a number");
          return false
        }
        if (parseInt(inputValue) > parseInt(itemPoints)) {
          swal.showInputError("Updated score should not greater than item points !");
          return false
        }
        if (parseInt(inputValue) < 0) {
            swal.showInputError("Updated Score Should not be lesser than zero !");
            return false
          }
        
        var newscore = inputValue;
        swal({
            title: "Are you sure?",
            text: "Do you want to update question score ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:'reports/updatequestionscore',
                data:{idusers:idusers,iduserquestionaire:iduserquestionaire,newscore:newscore,idquestionuseranswer:idquestionuseranswer,score:score,idquestion:idquestion},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        swal("Successs", "score successfully updated", "success");
                        window.location.reload();
                        /*
                        $('p.user-essay-item-score').text(newscore);
                        $('p#reports-user-total-score').text(data[2]);
                        var scorePercentage = ((((data[2])/(questionnaireTotalScore))*80)+20);
                        $('p#report-user-score-percentage').text(scorePercentage.toFixed(2).toString()+"%"); 
                        btn.data("questionscore",inputValue);
                        */
                    }else{
                        swal("Cancelled", "Fail to update", "error");
                    }
                }
            });
            } else {
                swal("Cancelled", "Canceled.", "error");
            }
        });
      });
      /*
    
    */
    
    
});

//
$(document).on('click','#btn-submit-approval',function(e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.data('id');
    swal({
        title: "Are you sure?",
        text: "Submit Approval ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Approved !",
        cancelButtonText: "No, ",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        
        if (isConfirm) {
            $.ajax({
                url:'notifications/approvequestionnaire',
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        swal("Success", "Approved", "success");
                        window.location.reload();
                    }else{
                        swal("Cancelled", data[0], "error");
                    }
                }
            });
        } else {
            swal("Cancelled", "Canceled.", "error");
        }
    });

});


// RETAKE EXAMINATION

$(document).on('click','.btn-retakeexamination',function(e){
    e.preventDefault();
    var btn = $(this);
    var form = btn.parent('form');
    var url = "reports/retakeexamination";
    

    swal({
        title: "Are you sure?",
        text: "Retake this student examination ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Retake Exam!",
        cancelButtonText: "No, ",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        
        if (isConfirm) {
            
            $.ajax({
            url:url,
            data:form.serialize(),
            dataType:"json",
            method:"POST",
            success:function(data){
                if(data[1] == true){
                    swal("Success", "Student Examination Record Deleted", "success");
                    window.location.reload();
                }else{
                    swal("Cancelled", data[0], "error");
                }
            }
        });
        } else {
            swal("Cancelled", "Canceled.", "error");
        }
    });
    
    
});

// RETAKE EXAMINATION END 

//ADD ANSWER
$(document).on('click','div.bhoechie-tab-content.active > center > div > div > span > button.btn-add-answer',function(e){
    e.preventDefault();
    var btn = $(this);
    var nextTab = $('ul.tab-header > li.active').index()-1;
    var itemNo = $('div.bhoechie-tab-menu.template'+nextTab+'>div.list-group > a.active').index();
    var answerQuantity = $('div#tab-content > div.active div.bhoechie-tab-content.active input.form-control').length;
    var input = '<div class="input-group">'
                    +'<span class="input-group-addon" id="basic-addon1">Hint no. '+(answerQuantity+1)+'</span>'
                    +'<input type="text" class="form-control use" placeholder="Enter Answer no '+(answerQuantity+1)+'" aria-describedby="basic-addon1" required="required" id="answerTabno-'+nextTab+'-itemno-'+itemNo+'-answerno-'+answerQuantity+'" name="answer">'
                +'</div>'
                +'<input type="hidden" readonly="readonly" id="idanswertabNo'+nextTab+'-itemno-'+itemNo+'answerno-'+answerQuantity+'" value="">';  
    $(input).insertBefore(btn);
});

//__userSessionUserLevelData 




///