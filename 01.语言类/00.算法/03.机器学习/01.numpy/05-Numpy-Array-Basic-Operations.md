## 05 ``numpy.array`` 基本操作


```python
import numpy as np
np.random.seed(0)

x = np.arange(10)
```


```python
x
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])




```python
X = np.arange(15).reshape((3, 5))
```


```python
X
```




    array([[ 0,  1,  2,  3,  4],
           [ 5,  6,  7,  8,  9],
           [10, 11, 12, 13, 14]])



### ``numpy.array`` 的基本属性


```python
x.ndim
```




    1




```python
X.ndim
```




    2




```python
x.shape
```




    (10,)




```python
X.shape
```




    (3, 5)




```python
x.size
```




    10




```python
X.size
```




    15



### ``numpy.array`` 的数据访问


```python
x
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])




```python
x[0]
```




    0




```python
x[-1]
```




    9




```python
X
```




    array([[ 0,  1,  2,  3,  4],
           [ 5,  6,  7,  8,  9],
           [10, 11, 12, 13, 14]])




```python
X[0][0] # 不建议！
```




    0




```python
X[0, 0]
```




    0




```python
X[0, -1]
```




    4




```python
x
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])




```python
x[0:5]
```




    array([0, 1, 2, 3, 4])




```python
x[:5]
```




    array([0, 1, 2, 3, 4])




```python
x[5:]
```




    array([5, 6, 7, 8, 9])




```python
x[4:7]
```




    array([4, 5, 6])




```python
x[::2]
```




    array([0, 2, 4, 6, 8])




```python
x[1::2]
```




    array([1, 3, 5, 7, 9])




```python
x[::-1]
```




    array([9, 8, 7, 6, 5, 4, 3, 2, 1, 0])




```python
X
```




    array([[ 0,  1,  2,  3,  4],
           [ 5,  6,  7,  8,  9],
           [10, 11, 12, 13, 14]])




```python
X[:2, :3]
```




    array([[0, 1, 2],
           [5, 6, 7]])




```python
X[:2][:3] # 结果不一样，在numpy中使用","做多维索引
```




    array([[0, 1, 2, 3, 4],
           [5, 6, 7, 8, 9]])




```python
X[:2, ::2]
```




    array([[0, 2, 4],
           [5, 7, 9]])




```python
X[::-1, ::-1]
```




    array([[14, 13, 12, 11, 10],
           [ 9,  8,  7,  6,  5],
           [ 4,  3,  2,  1,  0]])




```python
X[0, :]
```




    array([0, 1, 2, 3, 4])




```python
X[:, 0]
```




    array([ 0,  5, 10])



### Subarray of ``numpy.array``


```python
subX = X[:2, :3]
subX
```




    array([[0, 1, 2],
           [5, 6, 7]])




```python
subX[0, 0] = 100
subX
```




    array([[100,   1,   2],
           [  5,   6,   7]])




```python
X
```




    array([[100,   1,   2,   3,   4],
           [  5,   6,   7,   8,   9],
           [ 10,  11,  12,  13,  14]])




```python
X[0, 0] = 0
X
```




    array([[ 0,  1,  2,  3,  4],
           [ 5,  6,  7,  8,  9],
           [10, 11, 12, 13, 14]])




```python
subX
```




    array([[0, 1, 2],
           [5, 6, 7]])




```python
subX = X[:2, :3].copy()
```


```python
subX[0, 0] = 100
subX
```




    array([[100,   1,   2],
           [  5,   6,   7]])




```python
X
```




    array([[ 0,  1,  2,  3,  4],
           [ 5,  6,  7,  8,  9],
           [10, 11, 12, 13, 14]])



### Reshape


```python
x.shape
```




    (10,)




```python
x.ndim
```




    1




```python
x.reshape(2, 5)
```




    array([[0, 1, 2, 3, 4],
           [5, 6, 7, 8, 9]])




```python
x
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])




```python
A = x.reshape(2, 5)
A
```




    array([[0, 1, 2, 3, 4],
           [5, 6, 7, 8, 9]])




```python
x
```




    array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9])




```python
B = x.reshape(1, 10)
B
```




    array([[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]])




```python
B.ndim
```




    2




```python
B.shape
```




    (1, 10)




```python
x.reshape(-1, 10)
```




    array([[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]])




```python
x.reshape(10, -1)
```




    array([[0],
           [1],
           [2],
           [3],
           [4],
           [5],
           [6],
           [7],
           [8],
           [9]])




```python
x.reshape(2, -1)
```




    array([[0, 1, 2, 3, 4],
           [5, 6, 7, 8, 9]])




```python
x.reshape(3, -1)
```


    ---------------------------------------------------------------------------

    ValueError                                Traceback (most recent call last)

    <ipython-input-53-12a588b09f7f> in <module>()
    ----> 1 x.reshape(3, -1)
    

    ValueError: cannot reshape array of size 10 into shape (3,newaxis)

