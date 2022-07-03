document.addEventListener("DOMContentLoaded", function() {
 
    const likeBtnDOM = document.getElementsByClassName("like-shape");
    let requestLock = false;
 
    for (const like of likeBtnDOM) {
        // like.dataset.postID
        like.addEventListener("click", checkLikePost);
    }
 
 
    // functions
 
    function checkLikePost() {
        const thisElement = this;
        const postID = thisElement.dataset.postId ? thisElement.dataset.postId : 0;
        likeRequest(postID)
    }
 
    // ajax Request
 
    function likeRequest(postID) {
 
        if(requestLock)
            return;
 
        const xhr = new XMLHttpRequest();
        xhr.responseType = "json";
 
        requestLock = true;
 
        let queryString = new URLSearchParams;
 
        const params = new FormData;
        params.append("post_id", postID);
 
        xhr.open("POST", location.href + "/like-api.php");
 
        xhr.onload = function() {
            requestLock = false;
            const response = this.response;
 
            if(response.status == 1){
                const postLike = document.getElementById("post_like_" + response.post_id);
                postLike.classList.toggle("full");
                postLike.previousElementSibling.textContent = response.post_like;
            }else
                alert("خطایی رخ داده");
 
        }
 
        xhr.onerror = function() {
            requestLock = false;
            console.warn("[XHR Error]");
        }
 
        xhr.send(params);
 
    }
 
 
});