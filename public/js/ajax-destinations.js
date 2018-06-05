$(document).ready(function() {
        var string;
        $('#knownAddress').change(function(){
                string = $('#knownAddress').val()
                $.ajaxSetup({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                });
                $.ajax({
                        type:"GET",
                        url: "/knownusers/" + string,
                        success: function (data) {
                                console.log(data);
                                document.getElementById("postal_code").value = data[0].postal_code;
                                document.getElementById("house_number").value = data[0].house_number;
                                document.getElementById("address").value = data[0].address;
                                document.getElementById("city").value = data[0].city;
                                document.getElementById("township").value = data[0].township;
                                }
                });
        });
});



$(document).ready(function() {

        $('a[data-confirm]').click(function(ev) {
                var href = $(this).attr('href');
                if (!$('#dataConfirmModal').length) {
                        $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show:true});
                return false;
        });
});


 $(document).ready(function(){
                var url = "/destination";

                //display modal form for task editing
                $('.open-modal').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                //success data
                console.log(data);
                $('#task_id').val(data.destination_id);
                $('#ticket_id').val(data.ticket_id);
                $('#postal_code').val(data.postal_code);
                $('#address').val(data.address);
                $('#house_number').val(data.house_number);
                $('#city').val(data.city);
                $('#township').val(data.township);
                $('#verhicle').val(data.verhicle);
                $('#milage').val(data.milage);
                $('#btn-save').val("update");

                $('#myModal').modal('show');
                })
                });

                //display modal form for creating new task
                $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#destination').trigger("reset");
                $('#myModal').modal('show');
                });

                //delete task and remove it from list

                $('.delete-task').click(function(){

                var task_id = $(this).val();

                if(confirm("Bestemming verwijderen?")) {

                                $.ajaxSetup({
                                                headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                }
                                });

                $.ajax({

                type: "DELETE",
                url: url + '/' + task_id,
                success: function (data) {
                console.log(data);

                $("#destination" + task_id).remove();
                },
                error: function (data) {
                console.log('Error:', data);
                }
                });
                }
                else
                {
                        return false;
                }
                });


                //create new task / update existing task
                $("#btn-save").click(function (e) {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                })

                e.preventDefault();

                var formData = {
                                ticket_id: $('#ticket_id').val(),
                                postal_code: $('#postal_code').val(),
                                address: $('#address').val(),
                                house_number: $('#house_number').val(),
                                city: $('#city').val(),
                                township: $('#township').val(),
                                verhicle: $('#verhicle').val(),
                                milage: $('#milage').val(),
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save').val();

                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();
                var my_url = url;
                var formMessages = $('#messages');

                console.log(formData);

                $.ajax({

                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                console.log(data);

                        jQuery.each(data.success, function(key, data){
                        //formMessages.removeClass('alert-danger');
        		jQuery('.alert-success').show();
        		jQuery('.alert-success').append('<p>Bestemming is toegevoegd.</p>');
                        console.log(data);
                        });

                        jQuery.each(data.errors, function(key, data){
        		jQuery('.alert-danger').show();
        		jQuery('.alert-danger').append('<p>'+data+'</p>');
                        });

                // Make sure that the formMessages div has the 'success' class.

                var destination = '<tr id="destination' + data.id + '"><td>' + data.id + '</td><td>' + data.postal_code + '</td><td>'+ data.address +' '+ data.house_number + '</td>'
                                + '<td>' + data.city + '</td><td>' + data.township + '</td><td>' + data.verhicle + '</td><td>' + data.milage + '</td>';
                                destination += '<button class="btn btn-danger btn-xs btn-delete delete-task" value="' + data.id + '">Delete</button></td></tr>';

                if (state == "add"){ //if user added a new record
                $('#tasks-list').append(destination);
                }else{ //if user updated an existing record

                $("#destination" + task_id).replaceWith( destination );
                }

                $('#destination').trigger("reset");

                // $('#myModal').modal('hide')
                },
                error: function (data) {
                console.log('Error:', data);
                }
                });
                });
                });


        $(document).ready(function(){

                var url = "/finances";

                //display modal form for task editing
                $('.open-modal-payment').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                //success data
                console.log(data);
                $('#task_id').val(data.finances_id);
                $('#ticket_id').val(data.ticket_id);
                $('#payment_invoice').val(data.payment_invoice);
                $('#payment_gift').val(data.payment_gift);
                $('#payment_method').val(data.payment_method);
                $('#btn-save-payment').val("update");

                $('#myModal-payment').modal('show');
                })
                });

                //display modal form for creating new task
                $('#btn-add-payment').click(function(){
                $('#btn-save-payment').val("add");
                $('#finances').trigger("reset");
                $('#myModal-payment').modal('show');
                });

                //delete task and remove it from list

                $('.delete-task-payment').click(function(){

                var task_id = $(this).val();

                if(confirm("Betaling verwijderen?")) {

                                $.ajaxSetup({
                                                headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                }
                                });

                $.ajax({

                type: "DELETE",
                url: url + '/' + task_id,
                success: function (data) {
                console.log(data);

                $("#finances" + task_id).remove();
                },
                error: function (data) {
                console.log('Error:', data);
                }
                });
                }
                else
                {
                        return false;
                }
                });


                //create new task / update existing task
                $("#btn-save-payment").click(function (e) {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                })

                e.preventDefault();

                var formData = {
                                ticket_id: $('#ticket_id').val(),
                                payment_invoice: $('#payment_invoice').val(),
                                payment_gifts: $('#payment_gifts').val(),
                                payment_method: $('#payment_method').val(),
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save-payment').val();

                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();
                var my_url = url;
                var append = (append === undefined ? false : true);

                console.log(formData);

                $.ajax({

                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                console.log(data);


                        jQuery.each(data.errors, function(key, data){
        		jQuery('.alert-danger').show();
        		jQuery('.alert-danger').append('<p>'+data+'</p>');
                        });


                var finances = '<tr id="finances' + data.id + '"><td>' + data.payment_invoice + '</td><td>'+ data.payment_gifts + '</td>'
                                + '<td>' + data.payment_method + '</td><td><button class="btn btn-danger btn-xs btn-delete delete-task-payment" value="' + data.id + '">Verwijder</button></td></tr>';

                if (state == "add"){ //if user added a new record
                $('#finance-list').append(finances);
                }else{ //if user updated an existing record

                $("#finances" + task_id).replaceWith( finances );
                }
                $('#finances').trigger("reset");
                },
                complete: function(data) {
                if(data.status == 'success') {
                $('#myModal-payment').modal('hide')
                }
                },
                error: function (data) {
                console.log('Error:', data);
                }
                });
                });
                });


