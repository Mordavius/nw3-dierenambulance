var ticketfiltervalue;
var amountoftimes;
//var finishedtickets = document.getElementById('ticfin');
//var tfr =document.createElement('strong');

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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: 'api/ticketfilter/'+datefield +'/'+ animalfieldvalue +'/'+locationfield,
        success: function (data) {
            console.log(data);
            var i = 0;
            var finishedgrid = $('#finished');
            var unfinishedgrid = $('#unfinished');

            if (finishedgrid != null && unfinishedgrid != null){
                console.log(finishedgrid, unfinishedgrid);
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
                        '</a>'

                });
            }
            //var grid = $('.grid_main');


            // var i = 0;
            // if (document.getElementById('finished') != null) {
            //     document.getElementById('finished').innerHTML = '';
            //     data.tickets.forEach(function () {
            //        // if(data.tickets[i].finished > 0) {
            //         document.getElementById('finished').innerHTML += '<tr id="trdel' + data.tickets[i].id + '">' +
            //             '<td>' + data.animals[i].animal_species + '<br />' + data.animals[i].gender + '</td>' +
            //             '<td>' + data.animals[i].description + '</td>' +
            //             '<td>' + data.destinations[i].address + ' ' + data.destinations[i].house_number + '<br />' + data.destinations[i].postal_code + '<br />' + data.destinations[i].city + '</td>' +
            //             '<td>' + data.tickets[i].date + '<br />' + data.tickets[i].time + '</td>' +
            //             '<td><a href="/melding/' + data.tickets[i].id + '/edit"><i class="btn btn-primary">Aanpassen</i></a><br />' +
            //             '<a href="/melding/"' + data.tickets[i].id + '></a><i class="btn btn-primary">Bekijk</i><br />' +
            //             '<button class="btn btn-danger" onclick="deleteTicket(' + data.tickets[i].id + ')">Verwijderen</button> ' +
            //             '</td>' +
            //             '</tr>';
            //         //}
            //         document.getElementById('finishedtext').innerHTML = 'Afgeronde meldingen (gefilterd)';
            //         i++;
            //     });
            // }
            // else {
            //     alert('Geen bestaande meldingen')
            // }
        }
    });
}

function resetFilter(){
    location.reload(true);
}
