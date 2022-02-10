<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#tabel_product_category').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product_categories.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false , searchable: false},
            ]
        });

        
    });
</script>