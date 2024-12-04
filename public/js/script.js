$(document).ready(function() {
    async function getPosts() {
        $.ajax({
            url: '/post/get', 
            type: 'GET',
            success: function(response) {
                $('#postList').html(response);

                // Update all time-elapsed elements at once
                updateAllTimesElapsed();
            },
            error: function(xhr, status, error) {
                Dialog.showMessageDialog('Uh oh! :(', error);
            }
        });
    }

    $('#submitForm').on('submit', function(e) {
        e.preventDefault();

        const title = sanitizeInput($('#title').val());
        const content = sanitizeInput($('#content').val());

        $.ajax({
            url: '/post/store',
            type: 'POST',
            data: {
                title: title,
                content: content,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if ($('#emptyPostLabel').length === 1) {
                    $('#emptyPostLabel').remove();
                }

                addPost(response.data);
    
                $('#title').val('');
                $('#content').val('');
    
                Dialog.showMessageDialog('^_^', 'Your post has been uploaded!');
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.status === 422 ? 
                    Object.values(xhr.responseJSON.errors).map(err => `- ${err[0]}`).join('\n') : error;

                Dialog.showMessageDialog(`Uh oh! :(`, errorMessage);
            }
        });
    });

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

    function addPost(data) {
        const { title, content, created_at, user } = data;
        const postHtml = `
            <div class="blog-container">
                <div class="d-flex justify-content-between">
                    <h4>${title}</h4>
                    <p class="time-elapsed" data-created-at="${created_at}"></p>
                </div>
                <div>
                    <p>${content}</p>
                    <small>By: ${user.name}</small>
                </div>
            </div>
        `;
        
        $('#postList').prepend(postHtml);
        updateAllTimesElapsed(); // Update time-elapsed on new post
    }

    function sanitizeInput(str) {
        return str.replace(/<[^>]*>/g, ''); // Basic HTML sanitization
    }

    // Display welcome dialog
    Dialog.showPlainDialog(`
        <p><b>Welcome to blog posting!</b></p>
        <p>This list updates every <b><i>30 seconds</i></b>, post anything you want ty ^_^</p>
        <p><i>(you can also manually refresh the page to update)</i></p>
    `);

    // Get all posts on load
    getPosts();

    // Auto-refresh posts every 30 seconds
    setInterval(() => {
        getPosts();
        console.log('post refresh');
    }, 30000);
});