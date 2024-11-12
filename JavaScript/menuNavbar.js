// Function to smooth scroll to a target element
function smoothScroll(target) {
    const element = document.getElementById(target);
    if (element) {
        element.scrollIntoView({ behavior: "smooth", block: "start" });
    }
}

// Event listeners for navbar links
document.querySelectorAll("#stickyNavbar a").forEach(anchor => {
    anchor.addEventListener("click", function(e) {
        e.preventDefault();
        const targetId = this.getAttribute("href").substring(1); // Get the target ID without the '#'
        smoothScroll(targetId);
    });
});

// Calculate sections' offsets for sticky navbar visibility
const sections = [
    "vegEntrees", "nonVegEntrees", "chickenCurries", "lambCurries", 
    "goatCurries", "beefCurries", "seafoodCurries", "vegCurries", 
    "rice", "wholemealBread", "plainflourBread", "desserts", 
    "accompaniments", "beverages", "indoSoups", "indoVegEntrees", 
    "indoNonVegEntrees", "indoNoodles", "indoRice"
];

function toggleNavbarVisibility() {
    const currentScroll = window.scrollY;

    // Find the active section based on scroll position
    let activeSectionId = null;
    for (let i = 0; i < sections.length; i++) {
        const section = document.getElementById(sections[i]);
        if (section) {
            if (currentScroll >= section.offsetTop) {
                activeSectionId = sections[i];
            }
        }
    }

    // Highlight the active navbar link
    const navbarLinks = document.querySelectorAll("#stickyNavbar a");
    navbarLinks.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href").substring(1) === activeSectionId) {
            link.classList.add("active");
        }
    });
}

// Listen to scroll events for sticky navbar visibility
window.addEventListener("scroll", toggleNavbarVisibility);