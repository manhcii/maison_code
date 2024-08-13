newsData = [
  {
    imageURL: "./assets/images/news/hotnews-8.png",
    title:
      "Throwing Back the Bolt: Chevrolet Bolt Returns for Second Generation .",
    tags: ["Battery", "Car"],
    avatarURL: "./assets/images/user/u8.png",
    author: "Robert Fox",
    date: "June 28, 2018",
    des: "The now be been interesting over the past few years to drive vehicles from automakers that simply didn’t make them just a few years ago, and this is the latest one",
  },
  {
    imageURL: "./assets/images/news/hotnews-5.png",
    title: "Maybachh Camry Hybrid Vs. Honda Accar Hybrid: Which Is Best?",
    tags: ["Battery", "Engine"],
    avatarURL: "./assets/images/user/u3.png",
    author: "Albert Flores",
    date: "June 28, 2018",
    des: "Aenean eleifend ante maecenas pulvinar montes lorem et pede dis dolor pretium donec dictum. Vici",
  },
  {
    imageURL: "./assets/images/news/hotnews-2.png",
    title: "Toyota Camry Hybrid Vs. Honda Autos Accord Hybrid: Which Is Best?",
    tags: ["Battery", "Car"],
    avatarURL: "./assets/images/user/u5.png",
    author: "Wade Warren",
    date: "June 28, 2018",
    des: "Have to wait to see what the Bolt becomes, but the Equinox squatting so close to its territory opens up some exciting possibilities.",
  },
];

const handleNewsData = (newsData) => {
  return newsData.reduce(
    (addListNews, news) =>
      addListNews +
      `<div class="news">
        <div class="news-img">
          <img
            src="${news.imageURL}"
            alt="${news.title}"
            title="${news.title}"
          />
          <div class="news-tag">
          ${news.tags.map(
            (tag) => `<div class="news-tag-item">
          <span>${tag}</span>
        </div>`
          )}
          </div>
        </div>
        <div class="news-content">
        <a
          class="news-title"
          href="#"
          title="${news.title}"
        >${news.title}</a
        >
        <div class="news-reverse">
        <div class="news-info">
          <div class="news-info-avatar">
            <img
              src="${news.avatarURL}"
              alt="${news.author}"
              title="${news.author}"
            />
          </div>
          <p class="news-info-author">${news.author}</p>
          <div class="news-info-line"></div>
          <span class="news-info-date">${news.date}</span>
          <div class="news-info-dot">
            <svg
              width="6"
              height="6"
              viewBox="0 0 6 6"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M1.28 4.72C0.813333 4.24 0.58 3.66667 0.58 3C0.58 2.33333 0.813333 1.76667 1.28 1.3C1.76 0.82 2.33333 0.58 3 0.58C3.66667 0.58 4.23333 0.82 4.7 1.3C5.18 1.76667 5.42 2.33333 5.42 3C5.42 3.66667 5.18 4.24 4.7 4.72C4.23333 5.18667 3.66667 5.42 3 5.42C2.33333 5.42 1.76 5.18667 1.28 4.72Z"
                fill="#6C757D"
                fill-opacity="0.4"
              />
            </svg>
          </div>
          <div class="news-info-share">
            <img src="assets/images/blog-share.svg" alt="share" />
            <span>1K shares</span>
          </div>
        </div>
        <p class="news-des">
          ${news.des}
        </p>
        </div>
        </div>
      </div>`,
    ""
  );
};

const loadMoreHot = document.querySelector(".load-more-hot");
if (loadMoreHot) {
  loadMoreHot.addEventListener("click", () => {
    const list = document.querySelector(".hotnews-group");
    if (list && newsData) {
      const content = handleNewsData(newsData);
      list.insertAdjacentHTML("beforeend", content);
    }
  });
}

const handleNewsHorizontal = (newsData) => {
  return newsData.reduce(
    (addListNews, news) =>
      addListNews +
      `<div class="news news-horizontal">
        <div class="news-img">
          <img
            src="${news.imageURL}"
            alt="${news.title}"
            title="${news.title}"
          />
        </div>
        <div class="news-content">
        <a
          class="news-title"
          href="#"
          title="${news.title}"
        >${news.title}</a
        >
        <div class="news-reverse">
        <div class="news-info">
          <div class="news-info-avatar">
            <img
              src="${news.avatarURL}"
              alt="${news.author}"
              title="${news.author}"
            />
          </div>
          <p class="news-info-author">${news.author}</p>
          <div class="news-info-line"></div>
          <span class="news-info-date">${news.date}</span>
          <div class="news-info-dot">
            <svg
              width="6"
              height="6"
              viewBox="0 0 6 6"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M1.28 4.72C0.813333 4.24 0.58 3.66667 0.58 3C0.58 2.33333 0.813333 1.76667 1.28 1.3C1.76 0.82 2.33333 0.58 3 0.58C3.66667 0.58 4.23333 0.82 4.7 1.3C5.18 1.76667 5.42 2.33333 5.42 3C5.42 3.66667 5.18 4.24 4.7 4.72C4.23333 5.18667 3.66667 5.42 3 5.42C2.33333 5.42 1.76 5.18667 1.28 4.72Z"
                fill="#6C757D"
                fill-opacity="0.4"
              />
            </svg>
          </div>
          <div class="news-info-share">
            <img src="assets/images/blog-share.svg" alt="share" />
            <span>1K shares</span>
          </div>
        </div>
        <p class="news-des">
          ${news.des}
        </p>
        </div>
        <a href="#" class="news-view" title="View Post">View Post</a>
        </div>
      </div>`,
    ""
  );
};

const loadMoreList = document.querySelector(".load-more-list");
if (loadMoreList) {
  loadMoreList.addEventListener("click", () => {
    const list = document.querySelector(".newslist");
    if (list && newsData) {
      const content = handleNewsHorizontal(newsData);
      list.insertAdjacentHTML("beforeend", content);
    }
  });
}
