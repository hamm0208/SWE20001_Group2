// Static data for demonstration
var dataJson = {
    "Complete": [
        { "date": "2024-05-01", "count": 20 },
        { "date": "2024-05-02", "count": 30 },
        { "date": "2024-05-03", "count": 40 }
    ],
    "In Progress": [
        { "date": "2024-05-01", "count": 10 },
        { "date": "2024-05-02", "count": 15 },
        { "date": "2024-05-03", "count": 25 }
    ],
    "Cancelled": [
        { "date": "2024-05-01", "count": 5 },
        { "date": "2024-05-02", "count": 8 },
        { "date": "2024-05-03", "count": 7 }
    ]
};

// Process data and create datasets for Chart.js
var datasets = [];
for (var status in dataJson) {
    var dataset = {
        label: status,
        data: [],
        backgroundColor: getStatusColor(status) // Function to assign colors based on status
    };
    // Populate dataset with data
    dataJson[status].forEach(function(item) {
        dataset.data.push({ x: item.date, y: item.count });
    });
    datasets.push(dataset);
}

// Create Chart.js chart
var ctx = document.getElementById('orderChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar', // Use bar chart instead of line chart
    data: {
        datasets: datasets
    },
    options: {
        scales: {
            x: {
                type: 'time',
                time: {
                    unit: 'day' // Customize time scale
                },
                title: {
                    display: true,
                    text: 'Date'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Number of Orders'
                }
            }
        }
    }
});

// Function to assign colors based on status
function getStatusColor(status) {
    switch (status) {
        case 'Complete':
            return 'green';
        case 'In Progress':
            return 'orange';
        case 'Cancelled':
            return 'red';
        default:
            return 'grey';
    }
}
