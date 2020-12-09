<template>
    <nav class="navbar">

        <router-link class="navbar__brand"
        to="/"
        >
        <div class="title">
            <font-awesome-icon :icon="['far', 'question-cicle']" size='2x' />
            QA掲示板
        </div>
        </router-link>
        <p>夫婦・家族・育児にまつわる「教えて！」「聞いて！」のQ&A掲示板</p>

        <div class="navbar__menu">
            <div class="navbar__item">

                <span class="navbar__item">
                    username
                </span>

                <div class="navbar__item">
                    <router-link class="button"
                    to="/login"
                    >
                    ログイン / 会員登録
                    </router-link>
                </div>

            </div>

        </div>
    </nav>
</template>