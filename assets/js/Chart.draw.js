window.onload = function() {

    if (typeof data !== 'undefined') {
        var ctx = document.getElementById("login-chart");
        var lastLogin = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        });
    }

    if (typeof data2 !== 'undefined') {
        var ctx2 = document.getElementById("vote-chart");
        var averageVote = new Chart(ctx2, {
            type: 'bar',
            data: data2,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        });
    }

    if (typeof data3 !== 'undefined') {
        var ctx2 = document.getElementById("year-chart");
        var yearVote = new Chart(ctx2, {
            type: 'bar',
            data: data3,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        });
    }

    if (typeof data4 !== 'undefined') {
        var ctx2 = document.getElementById("avg-chart");
        var avgVote = new Chart(ctx2, {
            type: 'bar',
            data: data4,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        });
    }


}