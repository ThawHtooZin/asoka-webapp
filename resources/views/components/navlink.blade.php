<style>
    .nav-link {
        position: relative;
        overflow: hidden;
        /* To hide the background outside the link */
        padding: 8px 16px;
        display: inline-block;
        text-decoration: none;
        z-index: 1;
        /* Ensures the text is above the background */
    }

    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: -100%;
        width: 100%;
        height: 100%;
        /* Full height to cover the entire link */
        background-color: #0018a8;
        /* Your color (asokablue or any other) */
        transition: all 0.3s ease;
        /* Duration for the animation */
        z-index: -1;
        /* Positions the background behind the text */
    }

    .nav-link:hover::before {
        bottom: 0;
        /* Slide from left to right */
    }
</style>
<a
    {{ $attributes->merge(['href' => '#', 'class' => 'text-[16px] font-bold nav-link p-2 px-3 rounded-sm duration-300 hover:text-white']) }}>
    {{ $slot }}
</a>
