//prevents repeated form resubmissions if a user clicks browser refresh button
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}