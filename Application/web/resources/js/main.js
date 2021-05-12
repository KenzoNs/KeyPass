var _timer = 0;

function callSearchTimer() {

    if (_timer) {
        window.clearTimeout(_timer);
    }
    _timer = window.setTimeout(function(){
        search();
    }, 200);
}

function search(){
    $('#result_search').html('');

    const search = document.getElementById("search-input").value;
    const type = document.getElementById("search_type").value;

    if (search != ""){
        document.getElementById("container").style
        $.ajax({
            type: 'GET',
            url: '?module=' + type + '&action=search',
            data: 'value=' + encodeURIComponent(search),
            success: function (data){
                if(data != ""){
                    $('#result_search').append(data);
                }
                else{
                    document.getElementById('result_search').innerHTML = "<div>Rien</div>"
                }
            }
        });
    }
}