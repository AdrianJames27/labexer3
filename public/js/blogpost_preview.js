$(document).ready(function() {
    let currentPage = 1;

    async function getPosts(page) {
        $.ajax({
            url: `/post/get?page=${page}`, 
            type: 'GET',
            success: function(response) {
                $('#postList').html(response);

                currentPage = page;

                // Update all time-elapsed elements at once
                updateAllTimesElapsed();
            },
            error: function(xhr, status, error) {
                Dialog.showMessageDialog('Uh oh! :(', error);
            }
        });
    }

    function updateAllTimesElapsed() {
        setInterval(() => {
            $('.time-elapsed').each(function() {
                const element = $(this);
                updateTimeElapsed(element, element.data('created-at'));
            });
        }, 1000);
    }

    function updateTimeElapsed(element, createdAt) {
        const created = new Date(createdAt).getTime();
        const secondsElapsed = Math.floor((Date.now() - created) / 1000);
        const formatter = new Intl.RelativeTimeFormat('en-US', { style: 'short' });

        let timeString;

        if (secondsElapsed < 60) 
            timeString = formatter.format(-secondsElapsed, 'second');
        else if (secondsElapsed < 3600) 
            timeString = formatter.format(-Math.floor(secondsElapsed / 60), 'minute');
        else if (secondsElapsed < 86400) 
            timeString = formatter.format(-Math.floor(secondsElapsed / 3600), 'hour');
        else if (secondsElapsed < 604800) 
            timeString = formatter.format(-Math.floor(secondsElapsed / 86400), 'day');
        else if (secondsElapsed < 2419200) 
            timeString = formatter.format(-Math.floor(secondsElapsed / 604800), 'week');
        else if (secondsElapsed < 29030400) 
            timeString = formatter.format(-Math.floor(secondsElapsed / 2419200), 'month');
        else 
            timeString = formatter.format(-Math.floor(secondsElapsed / 29030400), 'year');

        element.text(timeString);
    }

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault(); // Prevent the default link behavior
    
        const url = $(this).attr('href'); // Get the URL from the link
        const page = new URL(url).searchParams.get('page'); // Extract the page number
        currentPage = page; // Update the current page
    
        getPosts(page); // Fetch posts for the selected page
    });

    // Display welcome dialog
    Dialog.showPlainDialog(`
        <p><b>Welcome to blog posting!</b></p>
        <p>This list updates every <b><i>30 seconds</i></b>.</p>
        <p><i>(you can also manually refresh the page to update)</i></p>
    `);

    // Get all posts on load
    getPosts(currentPage);

    // Auto-refresh posts every 30 seconds
    setInterval(() => {
        getPosts(currentPage);
        console.log('post refresh');
    }, 30000);
});