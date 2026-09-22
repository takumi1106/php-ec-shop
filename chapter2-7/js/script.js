document.querySelectorAll(".favorite-form").forEach(form => {
    form.addEventListener("submit", async (e) => {
        e.preventDefault(); // ページ遷移を止める

        const formData = new FormData(form);

        const res = await fetch(form.action, {
            method: "POST",
            body: formData
        });

        if (res.ok) {
            const btn = form.querySelector(".favorite-btn");

            if (btn.classList.contains("active")) {
                btn.classList.remove("active");
                btn.textContent = "☆";
                form.action = "favorite-insert.php";
            } else {
                btn.classList.add("active");
                btn.textContent = "★";
                form.action = "favorite-delete.php";
            }
        }
    });
});