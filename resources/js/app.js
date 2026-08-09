import "./bootstrap";
import "../scss/welcome.scss";

const themeSwitcher = document.querySelector("#theme-switcher");
const currentTheme = document.documentElement.dataset.theme || "default";

if (themeSwitcher) {
    themeSwitcher.value = currentTheme;
    themeSwitcher.addEventListener("change", () => {
        const theme = themeSwitcher.value === "terminal" ? "terminal" : "default";
        document.documentElement.dataset.theme = theme;

        try {
            localStorage.setItem("portfolio-theme", theme);
        } catch (_) {
            // Storage may be unavailable in private browsing environments.
        }
    });
}

document.querySelectorAll(".faq__question").forEach((button) => {
    button.addEventListener("click", () => {
        const item = button.closest(".faq__item");
        const answer = item.querySelector(".faq__answer");
        const isOpen = button.getAttribute("aria-expanded") === "true";

        button.setAttribute("aria-expanded", String(!isOpen));
        answer.hidden = isOpen;
        item.classList.toggle("faq__item--open", !isOpen);
    });
});

const menuToggle = document.querySelector(".header__toggle");
const navigation = document.querySelector(".header__nav");

menuToggle?.addEventListener("click", () => {
    const isOpen = menuToggle.getAttribute("aria-expanded") === "true";
    menuToggle.setAttribute("aria-expanded", String(!isOpen));
    navigation.classList.toggle("header__nav--open", !isOpen);
});

navigation?.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
        menuToggle?.setAttribute("aria-expanded", "false");
        navigation.classList.remove("header__nav--open");
    });
});
