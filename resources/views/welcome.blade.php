<x-main-layout>
    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <div class="space-y-2 pb-8 pt-6 md:space-y-5">
            <h1 class="text-3xl font-extrabold leading-9 tracking-tight text-gray-900 dark:text-gray-100 sm:text-4xl sm:leading-10 md:text-6xl md:leading-14">
                Latest
            </h1>
            <p class="text-lg leading-7 text-gray-500 dark:text-gray-400">
                A Article created with Laravel and Tailwind.css
            </p>
        </div>

        <ul class="divide-y divide-gray-200 dark:divide-gray-700">

            @foreach($articles as $article)

            <li class="py-12">
                <article>
                    <div class="space-y-2 xl:grid xl:grid-cols-4 xl:items-baseline xl:space-y-0">
                        <dl>
                            <dt class="sr-only">Published on</dt>
                            <dd class="text-base font-medium leading-6 text-gray-500 dark:text-gray-400">
                                {{ $article->published_at }}
                            </dd>
                        </dl>
                        <div class="space-y-5 xl:col-span-3">
                            <div class="space-y-6">
                                <div>
                                    <h2 class="text-2xl font-bold leading-8 tracking-tight">
                                        <a
                                            href={`/blog/${slug}`}
                                            class="text-gray-900 dark:text-gray-100"
                                        >
                                            {{ $article->title }}
                                        </a>
                                    </h2>
                                    <div class="flex flex-wrap">
                                        <a
                                            href='#'
                                            className="mr-3 text-sm font-medium uppercase text-primary-500 hover:text-primary-600 dark:hover:text-primary-400"
                                        >

                                        </a>
                                    </div>
                                </div>
                                <div class="prose max-w-none text-gray-500 dark:text-gray-400">
                                    {{ $article->content }}
                                </div>
                            </div>
                            <div class="text-base font-medium leading-6">
                                <a
                                    href={`/blog/${slug}`}
                                    class="text-primary-500 hover:text-primary-600 dark:hover:text-primary-400"
                                >
                                    Read more &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </li>
            @endforeach
        </ul>
    </div>
</x-main-layout>
