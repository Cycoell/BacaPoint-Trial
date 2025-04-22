document.addEventListener("DOMContentLoaded", function () {
const canvas = document.getElementById("genreChart");
    if (canvas) {
      fetch("../config/get_genre_data.php")
        .then((response) => response.json())
        .then((data) => {
          const labels = data.map((item) => item.genre);
          const counts = data.map((item) => parseInt(item.jumlah));

          const ctx = canvas.getContext("2d");
          new Chart(ctx, {
            type: "bar",
            data: {
              labels: labels,
              datasets: [{
                label: "Jumlah Buku per Genre",
                data: counts,
                backgroundColor: [
                  "#60a5fa", "#f472b6", "#34d399", "#facc15", "#f87171",
                  "#a78bfa", "#38bdf8", "#fb923c", "#10b981", "#ef4444"
                ],
                borderColor: "#ffffff",
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              plugins: {
                legend: { display: false },
                title: {
                  display: false,
                }
              },
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    stepSize: 1
                  }
                }
              }
            }
          });
        })
        .catch((error) => console.error("Error fetching data:", error));
    }});