
export const handleTest = function () {

    if ( !document.querySelector('.block-test') ) { 
        return;
    }

    const chartColors = {
        purple:        "#490E5A",
        gray1:         "#878785",
        blue:          "#042FAA",
        green1:        "#449699",
        purple2:       "#5E91EC",
        gray2:         "#4F5C66",
        blue2:         "#30B3E7",
        gold:          "#FAB023",
        purple3:       "#422E5D",
        green2:        "#A2AD00",
        green3:        "#8E9F87",
        purple4:       "#9E0389",
        gray3:         "#4A4A4A",
        silver:        "#F1F1F1",
        white:         "#FFFFFF",
        black:         "#000000",
        blue3:         "#006FBE"
    }   

    const chartBackgroundColors =  [ chartColors.purple, chartColors.gray1, chartColors.blue, chartColors.green1, chartColors.purple2,  chartColors.gray2,  chartColors.blue2,  chartColors.gold,  chartColors.purple3,  chartColors.green2, chartColors.green3, chartColors.purple4, chartColors.gray3, chartColors.silver, chartColors.white, chartColors.black, chartColors.blue3 ];

    let allPortfolioChartsBlocks = document.querySelectorAll('[id^="portfolio-charts-block_"]');
    let chartCounter = 0;

    // loop through all portfolio chart blocks on the page
    for ( let i = 0; i < allPortfolioChartsBlocks.length; i++ ) {

        let blockChartsJson = allPortfolioChartsBlocks[i].getAttribute("data-portfolio-charts-json");
        let blockChartsData = JSON.parse( blockChartsJson );

        // loop through eaach chart in the block
        for ( let j = 0; j < blockChartsData.length; j++ ) {

            let dataChartLabels = [], dataChartValues = [], dataChartValueLabelOverrides = [];
            let chartData = blockChartsData[j].chart_data;
         
            // get the chart data 
            for ( let k = 0; k < chartData.length; k++ ) {
                
                dataChartLabels.push( chartData[k].label );
                dataChartValues.push( chartData[k].value );
                dataChartValueLabelOverrides.push( 'not set' );

            }

            // Generate a chart.js chart
            let blockChartObj = prepareChartData( chartCounter, dataChartLabels,  dataChartValues, dataChartValueLabelOverrides )
            generateChart( blockChartObj );

            chartCounter++;
          
        }
        
    }


   function generateChart( chartData ) {
        
    //   let chartId = chartData[0].id;

        

       console.log( chartData );

        // let show_tooltip = true;
        // let is_override_exists = chartData[0].data.datasets[0].data_overrides[0];

        // if ( is_override_exists.length > 0 ) {
        //     show_tooltip = false;
        // }

        // new Chart( chartId, {
        //     type: "pie",
        //     data: chartData[0].data,
        //     options:  {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         cutout: '75%',
        //         plugins: {
        //             legend: {
        //                 display: false,
        //             },
        //             tooltip: {
        //                 enabled: show_tooltip,
        //                 callbacks: {
        //                     label: function(context) {

        //                         let label = context.parsed + '%';
        //                         return label;

        //                     }
        //                 }
        //             }
        //         },
        //     },
        // });

    }

    function prepareChartData( chartCounter, chartLabels, chartValues, chartValueOverrides ) {

        let chartObj = [
            { 
                id: "portfolio-chart-" + chartCounter,
                data: {
                    labels: chartLabels,
                    datasets: [{
                        data: chartValues,
                        data_overrides: chartValueOverrides,
                        backgroundColor: chartBackgroundColors,
                        borderWidth: 0,
                        borderRadius: 0,
                        hoverRadius: 0,
                        hoverBorderColor: "#FFFFFF",
                        label: false
                    }]
                },
            }   
        ];

        return chartObj;

    }

   

}
