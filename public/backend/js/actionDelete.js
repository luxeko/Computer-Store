function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: `Delete Data !!!`,
        text: `
        Continuing the action will delete the data permanently! Are you sure you want to delete the data?`,
        icon: 'warning',
        timer: 10000,
        timerProgressBar: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xoá!',

    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: urlRequest,
                method: 'GET',
                success: function (data) {
                    if(data.code == 200){
                        that.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Delete Successful.',
                            'success'
                        )
                    }
                },
            })
        }
    })
}

$(function(){
    $(document).on('click', '.action_delete', actionDelete);
});