<template>
    <transition name="confirmModal" appear>

        <div class="confirmModal modal-overlay">

            <div class="confirmModal_text modal-window">
                <slot class="confirmModal-text" name="confirmText">Do Action ?</slot>
            </div>

            <div class="confirmModal_button modal-window">
                <slot class="confirmModal-button" name="selectAction"></slot>
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
    width: 240px;
    background: #fff;
    overflow: hidden;
    padding: 16px 24px;
    text-align: center;
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