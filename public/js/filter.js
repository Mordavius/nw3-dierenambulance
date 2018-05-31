var ticketfiltervalue;
function filterTickets() {
    ticketfiltervalue = $('#tf').val();
    $.ajax({
        type: 'GET',
        url: 'api/ticketfilter/'+ ticketfiltervalue,
        success: function (data) {
            alert(data);
        }
    })
}