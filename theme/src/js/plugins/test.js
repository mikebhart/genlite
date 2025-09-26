
export const handleTest = function () {

    if ( !document.querySelector('.block-test') ) { 
        return;
    }

    // Prepare Data
    let allPortfolioCharts = document.querySelectorAll('[id^="portfolio-chart-block_"]');
    let allPortfolioDataCharts = [];
    let dataObjCounter = 0;

    // loop through all porfolio charts blocks
    for ( let i = 0; i < allPortfolioCharts.length; i++ ) {

        let blockChart = allPortfolioCharts[i].getAttribute("data-portfolio-chart-data");
        let blockChartData = JSON.parse( blockChart );
        let dataChartLabels = [];
        let dataChartValues = [];
        let title = '';

        // loop through eaach blocks chart 
        for ( let j = 0; j < blockChartData.length; j++ ) {

            title = blockChartData[j].title;

            let chartData = blockChartData[j].chart_data;
         
            // loop through eaach blocks chart series data 
            for ( let k = 0; k < chartData.length; k++ ) {
                
                let chartItemLabel = chartData[k].label;
                let chartItemValue = chartData[k].value;

                dataChartLabels.push( chartItemLabel );
                dataChartValues.push( chartItemValue );

            }

            // build up an array of all charts prepared ready for chart.js
            let chart = [
                { 
                    id: "portfolio-chart-" + dataObjCounter,
                    title: title,
                    data: {
                        labels: dataChartLabels,
                        datasets: [{
                            data: dataChartValues,
                            borderWidth: 0,
                            borderRadius: 0,
                            hoverRadius: 0,
                            hoverBorderColor: "#FFFFFF",
                            label: false
                        }]
                    },
                }   
            ];

            allPortfolioDataCharts.push( chart );

            dataObjCounter++;

        }
        
    }

    console.log( allPortfolioDataCharts );

}
