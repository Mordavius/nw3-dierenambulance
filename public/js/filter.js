function deleteTicket(ticketid) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var conf =  confirm("Klik op OK om de melding te verwijderen!");
    if (conf == true) {
        var trdel = document.getElementById('trdel' + ticketid);
        trdel.parentNode.removeChild(trdel);
        $.ajax({
            type: 'DELETE',
            url: '/tickets/' + ticketid,
            success: function (data) {
                alert(data);
            }
        })
    }
}

function filterTickets() {
    var datefield = $('#date').val();
    var animalfieldvalue = $('#animal_species').val();
    var locationfield = $('#location').val();


    if (animalfieldvalue == ''){
        animalfieldvalue = 'alles';
    }
    if (locationfield == ''){
        locationfield = 'alles';
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: 'api/ticketfilter/'+datefield +'/'+ animalfieldvalue +'/'+locationfield,
        success: function (data) {
            var i = 0;
            var finishedgrid = $('#finished');
            var unfinishedgrid = $('#unfinished');

            if (finishedgrid != null && unfinishedgrid != null){
                finishedgrid[0].innerHTML = '';
                unfinishedgrid[0].innerHTML = '';
                var selectedgrid;
                data.tickets.forEach(function () {
                    if(data.tickets[i].finished == 0){
                        selectedgrid = unfinishedgrid;
                    }
                    else if (data.tickets[i].finished == 1){
                       selectedgrid = finishedgrid;
                    }
                    selectedgrid[0].innerHTML += '<a href="/melding/'+data.tickets[i].id+'/edit">' +
                        '<article class="grid_ticket">' +
                        '<div class="test">' +
                        '</div>' +
                        '<div class="ticket_number">' +
                        '#'+ data.tickets[i].id +
                        '</div>' +
                        '<div class="grid_animal_icon">' +
                        '<div class="ticket_icon">' +
                        '<img src="/images/'+data.animals[i].animal_species+'.svg" id="animal_icon">' +
                        '</div>' +
                        '</div>' +
                        '<div class="ticket_main_info">' +
                        '<div class="ticket_title"><h3>'+data.animals[i].animal_species+'</h3></div>' +
                        '<div class="ticket_address"><span>' +
                        data.destinations[i].address+'<br />' +
                        data.destinations[i].postal_code+' ' +
                        data.destinations[i].city+
                        '</div>' +
                        '</div>'+
                        '</span>' +
                    '<p class="ticket_description">'+data.animals[i].description +'</p>' +
                        '</article>' +
                        '</a>';
                    i++;
                });
            }
        }
    });
}

function resetFilter(){
    location.reload(true);
}
