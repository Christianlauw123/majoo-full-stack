<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#tabel_product').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'product_category_id', name: 'product_category_id'},
                {data: 'action', name: 'action', orderable: false , searchable: false},
                
            ]
        });

        $('#product_categories').select2({
            theme: "bootstrap-5",
        });

        var description_selector = document.querySelector('#description');
        
        if (description_selector != null){
            ClassicEditor.create(description_selector).then(editor => {
                
            }).catch(error => {
                
            });
        }
        
    });

 
    $(function () {
        $(document).ready(function () {
            $('#ajax-alert').hide();
            var percent = $('#percent');
            $('form').ajaxForm({
                beforeSend: function () {
                    $('#ajax-alert').hide();
                    percent.css('width',"0%");
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    percent.css('width',percentComplete+"%");
                },
                complete: function (xhr) {
                    if (xhr.responseJSON.errors != undefined){
                        var err = xhr.responseJSON.errors;
                        var html = "<ul>";
                        for (var key in err) {
                            html += "<li>"+err[key][0]+"</li>";
                        }
                        html += "</ul>";
                        $('#ajax-alert').html(html);
                        $('#ajax-alert').show();
                        percent.css('width',"0%");
                    }else{
                        if (xhr.responseJSON.code == 200){
                            window.location.href = xhr.responseJSON.url;
                        }
                    }
                }
            });
        });
    });
     
    
</script>
</script>