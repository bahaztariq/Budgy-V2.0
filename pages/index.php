<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budgy - Your Dashboard for better Money Management</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="icon" href="../imgs/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sekuya&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="w-full fixed">
        <div class="w-full flex px-4 py-4 md:px-16  justify-between items-center ">
            <div class="flex items-center">
                <img src="imgs/icon.png" alt="" class="w-12 h-12">
                <h2 class="text-black text-3xl font-bold font-[sekuya] hidden md:flex">Budgy</h2>
            </div>
            <div class="flex gap-2 justify-between items-center">
                <a href="../auth/login.php" class=" flex justify-center items-center  text-black px-6 py-3 rounded-xl text-xl">Login</a>
                <a href="../auth/Register.php" class=" flex justify-center items-center bg-[#70E000] text-black px-4 py-1 rounded-full text-xl">Sign up</a>
            </div>
        </div> 
    </header>
    <section class="w-full h-screen flex flex-col justify-center items-center p-1 gap-4">
        <h3 class="text-xl font-[poppins]">Master your money, simplify your life</h3>
        <h1 class="text-4xl md:text-7xl text-center font-bold font-[sekuya]"><span class="text-[#70E000]">Budgy</span> Best Platform <br> to Manage Funds </h1>
        <p class="w-1/2 text-center">Take control of your financial future with our comprehensive money management platform. Track your income and expenses, set spending limits, manage multiple bank cards, and transfer money seamlessly—all in one secure place. Whether you're saving for a goal or simply staying organized, we make personal finance effortless.</p>
        <div class="flex gap-2">
            <a href="../auth/Register.php" class=" flex justify-center items-center bg-[#70E000] text-black px-4 py-2 rounded-full text-xl cursor-pointer">open an account</a>
            <a href="Dashboard.php" class=" flex justify-center items-center bg-black text-white px-4 py-2 rounded-full text-xl cursor-pointer">Send Money</a>
        </div>
    </section>
    <footer>
        
    </footer>
    
</body>
</html>
