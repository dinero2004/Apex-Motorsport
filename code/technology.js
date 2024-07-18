document.addEventListener("DOMContentLoaded", function () {
    fetch('json/data.json')
        .then(response => response.json())
        .then(data => displayBlogPosts(data.car_technology_news))
        .catch(error => console.error('Error fetching data:', error));
});

function displayBlogPosts(posts) {
    const container = document.getElementById('blog-container');
    posts.forEach(post => {
        const postElement = document.createElement('div');
        postElement.classList.add('blog-post');
        postElement.innerHTML = `
            <img src="${post.image}" alt="${post.title}" class="blog-post-image">
            <h3>${post.title}</h3>
            <p>${truncateText(post.summary, 150)}</p>
            <small>Source: ${post.source} | Date: ${post.date}</small>
        `;
        container.appendChild(postElement);
    });
}

function truncateText(text, maxLength) {
    return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
}