</div>
<footer class="site-footer">
    <div class="bottom-footer">
        <div class="container">
            <p class="text-center copyright">Copyright
                <script type="text/javascript">
                    var date = new Date();
                    document.write(date.getFullYear());
                </script>. All Rights Reserved
            </p>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    if (window.location.href.includes('success') || window.location.href.includes('error')) {
        history.pushState({}, null, window.location.origin + window.location.pathname);
    }

    function deleteProduct(prod_id) {
        let text = "Are you sure, you would like to delete this product?";
        if (confirm(text) == true) {
            window.location.href = 'deleteproduct.php?prod_id=' + prod_id
        }
    }

    if (document.getElementById('products-table'))
        new DataTable('#products-table');

    if (document.getElementById('users-table'))
        new DataTable('#users-table');
</script>
</body>

</html>