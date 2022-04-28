class Links {
    selectCategory($id) {
        let links = document.querySelectorAll('.link-category');
        links.forEach(link => {
            link.classList.remove("selected-category");
            if (link.getAttribute('id') == $id) link.classList.add("selected-category");
        });
    }
}

export default Links;