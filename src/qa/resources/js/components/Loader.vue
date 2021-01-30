<template>
    <transition name="modal" appear>
        <div class="loader modal-overlay">
            <div class="loading_text modal-window">
                <slot class="loading-text" name="loadingText">Loading...</slot>
            </div>
        </div>
    </transition>
</template>

<style lang="scss" scoped>
.modal {
    &-overlay {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 30;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    }
    &-window {
    width: 90%;
    background: #fff;
    border-radius: 4px;
    overflow: hidden;
    padding: 16px 24px;
    }
}

@media screen and (max-width: 896px) and (min-width: 481px) {
.modal {
    &-window {
        font-size: 1.5rem;
    }
}
}

@media screen and (min-width: 897px) {
.modal {
    &-window {
        font-size: 2rem;
    }
}
}

// trantision
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.4s;

    .modal-window {
        transition: opacity 0.4s, transform 0.4s;
    }
}
.modal-leave-active {
    transition: opacity 0.6s ease 0.4s;
}
.modal-enter,
.modal-leave-to {
    opacity: 0;

    .modal-window {
        opacity: 0;
        transform: translateY(-20px);
    }
}
</style>