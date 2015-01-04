<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
<style>
#mytable td {font-weight: bold;}
#mytable .third_col
{
	text-align:left;
	font-weight: normal;
}
</style>
</head>
<body>
<div class="CSSTableGenerator" >
                <table id="mytable" >
                    <tr>
                        <td>
                            SCORE
                        </td>
                        <td >
                            INTERPRETATION
                        </td>
						<td >
                            DETAIL
                        </td>
                    </tr>
                    <tr>
                        <td >
                            1
                        </td>
                        <td>
                            Gibberish Code
                        </td>
						<td class="third_col">
                            <ul>
								<li>The code written does not seem be related to the question asked. For e.g. for a problem requiring to sort a list 
								of numbers, the code attempts to find the maximum of two numbers.</li>
								<li>The code just has one or two lines and is mostly incomplete. </li>
								<li>The code has a ONLY pseudo-code and has few/no constructs of the programming language used.</li>
								<li>A part/all of the code has been written but has been placed within comments.</li>
								<li>Makes use of nested functions.</li>
								<li>A lot of code has been written. However, the written code has very parts in it which relate to the actual problem.
								Clearly shows a lack of conceptual understanding of programming.</li>
							</ul>
                        </td>
                    </tr>
                    <tr>
                        <td >
                           2
                        </td>
                        <td>
                            Emerging basic structures
                        </td>
						<td class="third_col">
                            <ul>
								<li>Very basic control structures present showing some understanding of a part of the problem.</li>
								<li>Solves the problem keeping only one test case in mind with incorrect data-dependencies. 
									For e.g. for a problem to print a 2-dimensional pattern, candidate understands that there exist two loops.
									Not sure of how to correctly manage the data though.</li>
								<li> Demonstrates that the candidate has seen a scenario (which is required in parts of the prob. statement) 
								before and is attempting to replicate it from memory.</li>
							</ul>
                        </td>
                    </tr>
                    <tr>
                        <td >
                           3
                        </td>
                        <td>
                            Inconsistent logical structures
                        </td>                       
						<td class="third_col">
                            <ul>
								<li>Right control structures start to appear with partially correct data dependencies.</li>
								<li>Has coded the primary function correctly. However, has made function calls to other functions but not implemented them.</li>
								<li>Solves the problem keeping only one test case in mind. Demonstrates unnecessary assumptions/simplifications to the problem 
								statemnt being made. (NOT TO BE CONFUSED WITH MISSING OUT ON EDGE CASES)</li>
							</ul>
                        </td>                       
                    </tr>
                    <tr>
                        <td >
                          4
                        </td>
                        <td>
                            Correct with silly errors
                        </td>
						<td class="third_col">
                            <ul>
								<li>Correct control structures and closely matching data-dependencies.</li>
								<li>Silly mistakes in the data dependency aspects of the code.</li>
							</ul>		
							Eg.
							<ul>
								<li>has used < instead of <= etc.</li>
								<li>has copy-pasted index 'i' and not changed to 'j'.</li>
								<li>Clearly shows an understanding of all aspects of the problem statement.</li>
							</ul>									
                        </td>
                    </tr>
					<tr>
                        <td >
                          5
                        </td>
                        <td>
                            Correct code but no edge-case handling
                        </td>
                        <td class="third_col">
                            <ul>
								<li>The implementation provided seems correct, both, according to the control-flow used and the data-flow used.</li>
								<li>However, the candidate has not attempted to handle the edge cases of the problem statement.</li>
							</ul>									
                        </td>						
                    </tr>
					<tr>
                        <td >
                          6
                        </td>
                        <td>                            
							Completely correct and but inefficient
                        </td>
                        <td class="third_col"> 
							<ul>
								<li>Fully correct code, with exception handling/edge-case handling.</li>
								<li>However, the solution presented is not optimal with respect to time complexity and/or space complexity.</li>
							</ul>									
                        </td>
                    </tr>
					<tr>
                        <td >
                          7
                        </td>
                        <td> 
                            Completely correct and efficient
                        </td>
                        <td class="third_col"> 
                            An efficient implementation of the problem using right control structures and data-dependencies.
                        </td>
                    </tr>
                </table>
				</div>
				</body>
				</html>