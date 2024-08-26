<div class="pb-20 pt-36">
    <div
        x-data="{ visible: true }"
        x-init="setTimeout(() => { visible = true }, 700)"
        :class="{ 'transition-opacity duration-1000 opacity-100': visible, 'opacity-0': !visible }"
        class="opacity-0"
    >
        <h1 class="text-xl font-bold text-white">Hello, Framer Motion!</h1>
    </div>
</div>
