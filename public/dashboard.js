$(function() {
    Morris.Bar({
        element: 'morris-bar-chart',
        data: BarData,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Quantidade'],
        hideHover: 'auto',
        resize: true
    });
});