    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Galerija 2018</small>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- WYSIWYG -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <!-- DropzoneJS -->
    <script src="js/dropzone.js"></script>

    <script src="js/script.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Pregledi',   <?php echo $session->count; ?>],
                ['Komentari',  <?php echo Comment::countAll(); ?>],
                ['Administratori',  <?php echo User::countAll(); ?>],
                ['Slike',      <?php echo Photo::countAll(); ?>]
            ]);

            var options = {
                title: 'Grafikon',
                legend: 'none',
                pieSliceText: 'label',
                backgroundColor: 'transparent'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    </div>
    <!-- /.content-wrapper-->

</body>

</html>
