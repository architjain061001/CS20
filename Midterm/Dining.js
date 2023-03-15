const restaurants = [
    {
        name: "Neptune Oyster",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/C38W5pjJWCY7IJZaV_p6Tw/o.jpg",
        description: "Tiny seafood spot offering lobster rolls, raw bar items & more in a snug, brick-lined setting.",
        rating: 4.5,
        cuisine: "Seafood",
        price: "$$",
        link: "https://www.yelp.com/biz/neptune-oyster-boston"
    },
    {
        name: "Sarma",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/O3GX-z03C6XBNqgVxiKooQ/o.jpg",
        description: "Inventive Middle Eastern small plates, craft cocktails & wines served in a cozy, rustic-chic space.",
        rating: 4.5,
        cuisine: "Middle Eastern",
        price: "$$",
        link: "https://www.yelp.com/biz/sarma-somerville"
    },
    {
        name: "Oleana",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/-dThJeVR5ehTQprFXGgbUA/o.jpg",
        description: "Inventive, upscale Mediterranean dishes with Middle Eastern flavors served in a stylish, rustic-chic setting.",
        rating: 4.5,
        cuisine: "Mediterranean",
        price: "$$",
        link: "https://www.yelp.com/biz/oleana-cambridge"
    },
    {
        name: "Mamma Maria",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/L1fGQjel0iHV6ZH8PBfk5Q/o.jpg",
        description: "Upscale, old-world Italian cuisine served in a romantic, elegant setting with city views.",
        rating: 4.5,
        cuisine: "Italian",
        price: "$$$",
        link: "https://www.yelp.com/biz/mamma-maria-boston"
    },
    {
        name: "Yvonne's",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/fIoZBGCTqNuMsk0YgLr5gg/o.jpg",
        description: "Sleek, stylish space offering elevated American fare, cocktails & wine, plus live music on weekends.",
        rating: 4.5,
        cuisine: "American",
        price: "$$$",
        link: "https://www.yelp.com/biz/yvonnes-boston"
    },
    {
        name: "Toro",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/vavJneJjBulHvZAGit-bdQ/o.jpg",
        description: "Small plates & Spanish wines served in a high-energy, rustic-modern space with a patio & open kitchen.",
        rating: 4.5,
        cuisine: "Spanish",
        price: "$$",
        link: "https://www.yelp.com/biz/toro-boston-3"
    },
    {
        name: "L'Espalier",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/MVdMf4ka_RC_D4tdTyHJZg/348s.jpg",
        description: "Elegant French-New England cuisine, wine & cocktails served in a refined townhouse space with a garden.",
        rating: 4.5,
        cuisine: "French",
        price: "$$$",
        link: "https://www.yelp.com/biz/lespalier-boston"
    },
    {
        name: "Union Oyster House",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/_TCUbSbeuXpk_8xrZcS_FQ/o.jpg",
        description: "Historic seafood spot serving classic New England fare in a traditional setting with a downstairs bar.",
        rating: 4.0,
        cuisine: "Seafood",
        price: "$$",
        link: "https://www.yelp.com/biz/union-oyster-house-boston"
    },
    {
        name: "Myers + Chang",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/aJsd15Ml63unh2Jsyuu39w/348s.jpg",
        description: "Modern Asian-American plates & cocktails served in a stylish, lively space with a bar & communal tables.",
        rating: 4.5,
        cuisine: "Asian Fusion",
        price: "$$",
        link: "https://www.yelp.com/biz/myers-chang-boston"
    },
    {
        name: "Pammy's",
        image: "https://s3-media0.fl.yelpcdn.com/bphoto/SA7hziTNxryzOmtNxJLlAA/o.jpg",
        description: "New American plates & cocktails served in a cozy, rustic-chic space with an open kitchen & patio seating.",
        rating: 4.5,
        cuisine: "New American",
        price: "$$",
        link: "https://www.yelp.com/biz/pammys-cambridge-2"
    },
]




const restaurantList = document.getElementById("restaurant-list");

restaurants.forEach((restaurant) => {
    // create a new card element for each restaurant
    const card = document.createElement("div");
    card.classList.add("card");

    // add restaurant image
    const imageContainer = document.createElement("div");
    imageContainer.classList.add("card-img-container");
    const image = document.createElement("img");
    image.classList.add("card-img-top");
    image.src = restaurant.image;
    imageContainer.appendChild(image);
    card.appendChild(imageContainer);

    // add restaurant name
    const name = document.createElement("h5");
    name.classList.add("card-title");
    name.textContent = restaurant.name;
    card.appendChild(name);

    // add restaurant description
    const description = document.createElement("p");
    description.classList.add("card-text");
    description.textContent = restaurant.description;
    card.appendChild(description);

    // add restaurant rating
    const rating = document.createElement("p");
    rating.classList.add("card-text");
    rating.textContent = `Rating: ${restaurant.rating}`;
    card.appendChild(rating);

    // add restaurant cuisine
    const cuisine = document.createElement("p");
    cuisine.classList.add("card-text");
    cuisine.textContent = `Cuisine: ${restaurant.cuisine}`;
    card.appendChild(cuisine);

    // add restaurant price
    const price = document.createElement("p");
    price.classList.add("card-text");
    price.textContent = `Price: ${restaurant.price}`;
    card.appendChild(price);

    // add link to Yelp page
    const link = document.createElement("a");
    link.classList.add("stretched-link");
    link.href = restaurant.link;
    card.appendChild(link);

    // Add onClick event listener to open Yelp link
    card.addEventListener("click", () => {
        window.open(restaurant.link, "_blank");
    });

    // add card to the restaurant list
    restaurantList.appendChild(card);
});
