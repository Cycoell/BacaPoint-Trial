document.addEventListener('DOMContentLoaded', function() {
  let chart;
  
  // Initial load
  loadChartData();
  
  // Chart type switcher
  document.getElementById('chartType').addEventListener('change', function() {
      if (chart) {
          chart.destroy();
          loadChartData();
      }
  });
  
  function loadChartData() {
      const loading = document.getElementById('loading');
      const errorMessage = document.getElementById('errorMessage');
      
      loading.classList.remove('hidden');
      errorMessage.classList.add('hidden');
      
      fetch('../config/get_genre_data.php')
          .then(response => {
              if (!response.ok) throw new Error('Network response was not ok');
              return response.json();
          })
          .then(data => {
              // Update stats
              document.getElementById('totalGenres').textContent = data.length;
              
              const totalBooks = data.reduce((sum, item) => sum + parseInt(item.jumlah), 0);
              document.getElementById('totalBooks').textContent = totalBooks;
              
              const popular = data.reduce((prev, current) => 
                  (prev.jumlah > current.jumlah) ? prev : current
              );
              document.getElementById('popularGenre').textContent = `${popular.genre} (${popular.jumlah})`;
              
              // Render chart
              renderChart(data);
              loading.classList.add('hidden');
          })
          .catch(error => {
              console.error('Error:', error);
              loading.classList.add('hidden');
              errorMessage.classList.remove('hidden');
              document.getElementById('errorText').textContent = 
                  `Error: ${error.message || 'Gagal memuat data'}`;
          });
  }
  
  function renderChart(data) {
      const ctx = document.getElementById('genreChart').getContext('2d');
      const chartType = document.getElementById('chartType').value;
      
      chart = new Chart(ctx, {
          type: chartType,
          data: {
              labels: data.map(item => item.genre),
              datasets: [{
                  label: 'Jumlah Buku',
                  data: data.map(item => parseInt(item.jumlah)),
                  backgroundColor: [
                      '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                      '#EC4899', '#14B8A6', '#F97316', '#64748B', '#84CC16'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      position: 'right',
                      labels: {
                          boxWidth: 12,
                          padding: 20
                      }
                  },
                  tooltip: {
                      enabled: true,
                      mode: 'index',
                      intersect: false
                  }
              },
              scales: chartType === 'bar' ? {
                  y: {
                      beginAtZero: true,
                      ticks: {
                          stepSize: 1
                      }
                  }
              } : undefined
          }
      });
  }
});