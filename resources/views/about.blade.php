@extends('layouts.app')

@section('content')
<div class="container">
    <div class="border-bottom py-3 mb-3">
        <h1>About</h1>
    </div>

    @markdown
    Core Values is a simple app to help you determine your top 5 core values.

    Simply answer a series of comparison questions (This vs That) and when
    you're done you'll have a list of the top 5.

    ## How It Works

    To illustrate how the sorting works. I'll use a list of numbers that we're
    trying to sort. Obviously core values don't have quantitative values that
    we're sorting. But this will show why questions are asked and what the answers
    mean.

    We start out with a randomized list of core values. We take the first item from
    this list and add it to the sorted list.

    ```
    2 5 1 4 7 3 6 9 <- This is the values list

    8 <- This is the sorted list
    ```

    We take the first item from the values list and compare it to the
    lowest priority item in the sorted list. In this case 2 vs 8.

    ```
    5 1 4 7 3 6 9 <- This is the values list

    2 <- Value we'll be comparing

    (8) <- 8 is the only value, so it's the lowest
    ```

    When we compare 2 vs 8, 8 is greater than 2 so we choose 8 as the higher
    priority. 2 is placed after 8. We take 5 off the list as the next value
    we'll compare.

    ```
    1 4 7 3 6 9 <- This is the values list

    5 <- Value we'll be comparing

    8 (2) <- 2 is the lowest priority value
    ```

    We then compare 5 vs 2. In this case 5 is a higher priority than 2 so we
    compare the next highest priority, which is 8.

    ```
    1 4 7 3 6 9 <- This is the values list

    5 <- Value we'll be comparing

    (8) 2 <- 8 is the next highest priority value
    ```

    We compare 5 vs 8 and choose 8 as the higher priority value. 5 gets
    placed after 8 in the sorted list. The next value to compare is 1.

    ```
    4 7 3 6 9 <- This is the values list

    1 <- Value we'll be comparing

    8 5 (2) <- 2 is the lowest priority value
    ```

    Next we compare 1 vs 2 and choose 2. 1 is placed after 2. The next
    value to compare is 4.

    ```
    7 3 6 9 <- This is the values list

    4 <- Value we'll be comparing

    8 5 2 (1) <- 1 is the lowest priority value
    ```

    We compare 4 vs 1 and choose 4. We then compare 4 vs 2 and choose 4.
    We compare 4 vs 5 and choose 5 so 4 goes after 5 in the sorted list.
    The next value we compare is 7.

    ```
    3 6 9 <- This is the values list

    7 <- Value we'll be comparing

    8 5 4 2 (1) <- 1 is the lowest priority value
    ```

    We compare 7 vs 1 and choose 7. We compare 7 vs 2 and choose 2. We compare
    7 vs 4 and choose 7. We compare 7 vs 5 and choose 7. We compare 7 vs 8,
    choose 8. 7 is placed after 8 in the sorted array.

    ```
    3 6 9 <- This is the values list

    8 7 5 4 2 (1) <- 1 is the lowest priority value
    ```

    Now. Because we're only looking for the top 5 values, and our sorted
    list has 6 items in it, we remove any items after the top 5. We remove
    value 1, so value 2 is now the lowest priority value in the top 5. The
    next value we compare is 3.

    ```
    6 9 <- This is the values list

    3 <- Value we'll be comparing

    8 7 5 4 (2) <- 2 is the lowest priority value
    ```

    We compare 3 vs 2 and choose 2. We compare 3 vs 4 and choose 4.
    3 is placed after 4 in the sorted list. We remove 2 from the list
    because it's the 6th highest priority. The next value we compare is 6.

    ```
    9 <- This is the values list

    6 <- Value we'll be comparing

    8 7 5 4 (3) <- 3 is the lowest priority value
    ```

    We compare 6 vs 3 and choose 6. We compare 6 vs 4 and choose 6.
    We compare 6 vs 7 and choose 7. We place 6 after 7 in the sorted
    list. We remove value 3 from the list. The next value we compare is 9.

    ```
    <- No more items in the values list

    9 <- Value we'll be comparing

    8 7 6 5 (4) <- 4 is the lowest priority value
    ```

    We compare 9 vs 4 and choose 9. We compare 9 vs 5 and choose 9.
    We compare 9 vs 6 and choose 9. We compare 9 vs 7 and choose 9.
    We compare 9 vs 8 and choose 9. There are no higher priority items
    in the sorted list so we add 9 to the start of the list. We remove
    4 from the list. There are no more items in the values list so
    we are done with the quiz.

    ```
    9 8 7 6 5 <- Final list of top 5 values.
    ```

    This source code is available on [GitHub](https://github.com/geekitycom/core-values).
    @endmarkdown

</div>
@endsection
