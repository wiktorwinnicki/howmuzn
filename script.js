document.addEventListener('DOMContentLoaded', () => {
    function toggleDropdown() {
        const dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    }

    // Ensure gallery-related elements are present
    const galleryContainer = document.querySelector('.image-container');
    const popupImage = document.querySelector('.popup-image');
    const popupImageSpan = document.querySelector('.popup-image span');

    if (galleryContainer) {
        galleryContainer.querySelectorAll('img').forEach(image => {
            image.addEventListener('click', () => {
                if (popupImage) {
                    popupImage.style.display = 'block';
                    const popupImageContent = popupImage.querySelector('img');
                    if (popupImageContent) {
                        popupImageContent.src = image.getAttribute('src');
                    }
                }
            });
        });
    }

    if (popupImageSpan) {
        popupImageSpan.addEventListener('click', () => {
            if (popupImage) {
                popupImage.style.display = 'none';
            }
        });
    }

    // Ensure book-related elements are present
    const book = document.querySelector(".book");
    const frontpage = document.querySelector(".front-page");

    if (book && frontpage) {
        book.addEventListener('click', () => {
            book.classList.toggle("flip");
        });

        frontpage.addEventListener('mouseenter', () => {
            book.classList.add("rotateLeft");
        });

        frontpage.addEventListener('mouseout', () => {
            book.classList.remove("rotateLeft");
        });
    }

    const stars = document.querySelectorAll('.star:not(.non-interactive)');
    const reviewText = document.getElementById('review-text');
    const submitReviewBtn = document.getElementById('submit-review');
    const reviewList = document.getElementById('review-list');

    if (stars.length > 0 && reviewText && submitReviewBtn && reviewList) {
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', () => {
                selectedRating = parseInt(star.getAttribute('data-rating'), 10);
                updateStars();
            });
            star.addEventListener('mouseover', () => {
                const rating = parseInt(star.getAttribute('data-rating'), 10);
                updateStars(rating);
            });
            star.addEventListener('mouseout', () => {
                updateStars(selectedRating);
            });
        });

        reviewList.addEventListener('click', (e) => {
            if (e.target.classList.contains('delete-review-btn')) {
                const reviewId = e.target.getAttribute('data-review-id');

                fetch('delete_review.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `review_id=${reviewId}`
                })
                .then(response => response.text())
                .then(message => {
                    alert(message);
                    if (message === "Review deleted successfully.") {
                        location.reload();
                    }
                });
            }
        });

        function updateStars(rating = selectedRating) {
            stars.forEach(star => {
                const starRating = parseInt(star.getAttribute('data-rating'), 10);
                if (starRating <= rating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }

        if (submitReviewBtn) {
            submitReviewBtn.addEventListener('click', () => {
                const text = reviewText.value.trim();

                if (selectedRating > 0 && text) {
                    fetch('submit_review.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `rating=${selectedRating}&text=${encodeURIComponent(text)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    });
                } else {
                    alert('Please select a rating and write a review.');
                }
            });
        }
    }

    // Attach event listener to dropdown button
    const dropdownBtn = document.querySelector('.dropdown-btn');
    if (dropdownBtn) {
        dropdownBtn.addEventListener('click', toggleDropdown);
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const dropdownBtn = document.querySelector('.dropdown-btn');

        if (!dropdownMenu.contains(event.target) && !dropdownBtn.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
