$("#delete").on('click',function(event){
    event.preventDefault();
    $("#deleteArticle").modal();
});

$("#sureDelete").on('click',function(event){
    event.preventDefault();
    $.ajax({
        method: 'POST',
        url: urlDeleteArticle,
        data:{
            article_id: article_id,
            _token: _token
            },
        success: function(data){
            if(data == 1000){
                $('#deleteArticle').hide();
                alert('Delete successfully!!!');
                window.location.href = urlArticlesList;
            }
        }
    });
});