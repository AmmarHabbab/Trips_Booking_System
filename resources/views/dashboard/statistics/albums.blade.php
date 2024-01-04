<!DOCTYPE html>
<html>
<head>
    <title>Laravel ChartJS Example</title>
</head>
<body>
    <!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<canvas id="myChart"></canvas>
<script>
 const ctx = document.getElementById('myChart').getContext('2d');
 const labels = [
    @foreach($mostLikedAlbums as $album)
      '{{ $album->name }}',
    @endforeach
 ];
 const data = {
    labels: labels,
    datasets: [{
      label: 'Likes',
      data: [
        @foreach($mostLikedAlbums as $album)
          '{{ $album->likes_count }}',
        @endforeach
      ],
      backgroundColor: [
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
      ],
      borderColor: [
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
      ],
      borderWidth: 1
    }]
 };
 const options = {
    scales: {
      y: {
        beginAtZero: true
      } 
    }
 };
 const myChart = new Chart(ctx, {
    type: 'bar', // bar - pie
    data: data,
    options: options
 });
</script>
</body>
</html>