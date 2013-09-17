$(document).ready(function(){
    /* FlowType */
    if ($ft_state){
        $('body').flowtype({
            minimum  :500,
            maximum  :1200,
            minFont  :8,
            maxFont  :40,
            fontRatio:75,
            lineRatio:1.3
        });
    }
});