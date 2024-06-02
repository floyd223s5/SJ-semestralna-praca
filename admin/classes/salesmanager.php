<?php
class SalesManager {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getSalesData() {
        $sql = "SELECT DATE_FORMAT(created_at, '%b %Y') as month, SUM(total_price) as total_sales 
                FROM orders 
                GROUP BY month";

        $result = $this->db->query($sql);
        $salesData = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $month = $row['month'];
                $totalSales = (float)$row['total_sales'];
                $salesData[] = array($month, $totalSales);
            }
        }

        return $salesData;
    }

    public function renderSalesChart() {
        $salesData = $this->getSalesData();

        echo '<br><br><br>
        <div class="container py-5">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load("current", {"packages":["bar"]});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ["Mesiac", "Celkový predaj"],';
        
        foreach ($salesData as $sales) {
            echo "['{$sales[0]}', {$sales[1]}],";
        }

        echo ']);

                    var options = {
                        chart: {
                            title: "Mesačné Predaje",
                            subtitle: "2024",
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById("columnchart_material"));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="width: 800px; height: 500px;" class="shadow"></div>
        </div>';
    }
}
?>
